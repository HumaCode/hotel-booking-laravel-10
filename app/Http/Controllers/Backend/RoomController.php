<?php

namespace App\Http\Controllers\Backend;

use App\Models\Room;
use App\Models\Facility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MultiImage;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use PHPUnit\Framework\Constraint\Count;

class RoomController extends Controller
{
    public function editRoom($id)
    {
        $editData       = Room::findOrFail($id);
        $multiImgs      = MultiImage::where('rooms_id', $id)->get();
        $basic_facility = Facility::where('rooms_id', $id)->get();

        return view('backend.allroom.rooms.edit_rooms', compact('editData', 'basic_facility', 'multiImgs'));
    }

    public function updateRoom(Request $request, $id)
    {
        $room   = Room::findOrFail($id);

        $validated = $request->validate([
            'total_adult'       => 'required',
            'total_child'       => 'required',
            'room_capacity'     => 'required',
            'price'             => 'required',
            'size'              => 'required',
            'view'              => 'required',
            'bed_style'         => 'required',
            'discount'          => 'required',
            'short_desc'        => 'required',
            'description'       => 'required',
            // 'image'     => 'nullable|image|mimes:jpeg,png,jpg|max:5000',
        ]);


        if ($request->file('image')) {

            // unlink foto
            if ($room->image <> "") {
                unlink($room->image);
            }

            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(550, 850)->save('uploads/rooming/' . $name_gen);
            $save_url = 'uploads/rooming/' . $name_gen;

            $room->image = $save_url;
        }

        $room->roomtype_id      = $room->roomtype_id;
        $room->total_adult      = $validated['total_adult'];
        $room->total_child      = $validated['total_child'];
        $room->room_capacity    = $validated['room_capacity'];
        $room->price            = $validated['price'];
        $room->size             = $validated['size'];
        $room->view             = $validated['view'];
        $room->bed_style        = $validated['bed_style'];
        $room->discount         = $validated['discount'];
        $room->short_desc       = $validated['short_desc'];
        $room->description      = $validated['description'];
        $room->updated_at       = Carbon::now();
        $room->save();

        // update facility table
        if ($request->facility_name == NULL) {
            $notification = [
                'message'       => 'Sorry! Not Any Basic Facility Select.',
                'alert-type'    => 'error'
            ];

            return redirect()->back()->with($notification);
        } else {
            Facility::where('rooms_id', $id)->delete();

            $facilities = Count($request->facility_name);
            for ($i = 0; $i < $facilities; $i++) {
                $fcount = new Facility();
                $fcount->rooms_id       = $room->id;
                $fcount->facility_name  = $request->facility_name[$i];
                $fcount->save();
            }
        }


        // update multiImage
        if ($room->save()) {
            $files = $request->multi_img;
            // if (!empty($files)) {
            //     $subimage = MultiImage::where('rooms_id', $id)->get()->toArray();

            //     unlink($subimage->multi_img);
            //     MultiImage::where('rooms_id', $id)->delete();
            // }
            if (!empty($files)) {
                $subimages = MultiImage::where('rooms_id', $id)->get();

                foreach ($subimages as $subimage) {
                    $imagePath = $subimage->multi_img; // Path gambar
                    $tempImage = pathinfo($imagePath, PATHINFO_FILENAME); // Nama file temporernya (tanpa ekstensi)

                    // Hapus gambar dari sistem file jika ada
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }

                    // Hapus folder jika file temporernya ada
                    $folderPath = dirname($imagePath); // Path folder yang berisi gambar
                    $tempImagePath = $folderPath . '/' . $tempImage . '.tmp'; // Path file temporernya

                    if (file_exists($tempImagePath)) {
                        unlink($tempImagePath);
                    }

                    // Hapus entri gambar dari database
                    $subimage->delete();

                    // Hapus folder jika kosong
                    if (count(glob($folderPath . '/*')) === 0) {
                        rmdir($folderPath);
                    }
                }
            }

            if (!empty($files)) {
                foreach ($files as $file) {
                    $imgName = date('YmdHi') . $file->getClientOriginalName();
                    $imageName = $file->move('uploads/rooming/multi_img/' . $imgName);
                    $subimage['multi_img'] = $imgName;

                    $subimage = new MultiImage();
                    $subimage->rooms_id     = $room->id;
                    $subimage->multi_img    = $imageName;
                    $subimage->save();
                }
            }
        }

        $notification = [
            'message'       => 'Room Update Successfully.',
            'alert-type'    => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function multiImageDelete($id)
    {
        $deletedata = MultiImage::where('id', $id)->first();
        if ($deletedata) {
            $imagePath = $deletedata->multi_img;

            if (file_exists($imagePath)) {
                unlink($imagePath);
                echo 'Image Unlinked Successfully.';

                // Mendapatkan path folder yang berisi gambar
                $folderPath = dirname($imagePath);

                // Mendapatkan nama file temporernya (tanpa ekstensi)
                $tempImage = pathinfo($imagePath, PATHINFO_FILENAME);

                // Path file temporernya
                $tempImagePath = $folderPath . '/' . $tempImage . '.tmp';

                // Hapus file temporernya jika ada
                if (file_exists($tempImagePath)) {
                    unlink($tempImagePath);
                }

                // Hapus folder jika kosong
                if (count(glob($folderPath . '/*')) === 0) {
                    rmdir($folderPath);
                }
            } else {
                echo 'Image Does not exist.';
            }

            $deletedata->delete(); // Menghapus entri gambar dari database
        } else {
            echo 'Image Data Does not exist.';
        }

        $notification = [
            'message'       => 'MultiImage deleted Successfully.',
            'alert-type'    => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
