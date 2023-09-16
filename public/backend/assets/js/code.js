$(function(){
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete This Data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      Swal.fire({
                        title: 'Deleted!',
                        text: 'Your file has been deleted.',
                        type: 'success',
                        showCancelButton: false, // Hilangkan tombol batal
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Oke', // Ganti teks tombol menjadi "Oke"
                        closeOnConfirm: false,
                      }).then((result) => {
                        if (result.isConfirmed) {
                          window.location.href = link; // Ganti 'link' dengan URL yang diinginkan
                        }
                      });
                    }
                  }) 


    });

  });