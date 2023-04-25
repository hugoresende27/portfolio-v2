const urlForm = document.querySelector('form');
urlForm.addEventListener('submit', async (event) => {
    event.preventDefault(); // Prevents the default form submission


    const url = urlForm.action;
    const urlToScrap = document.querySelector('#url').value;


    try {
        await Swal.showLoading();
        const response = await axios.post(url,{
            'url':urlToScrap
        });

        console.log(response.data.div_attributes)
        const  success  = response.status;

        if (success === 200) {
            await Swal.fire({
                title: 'Scrap done successfully',
                color: 'white',
                html: '<p>'+JSON.stringify(response.data)+'</p>',
                background: '#374151',
                confirmButtonColor: '#111827',
                confirmButtonText: 'OK',
            });

        } else {
            await Swal.fire({
                title: 'Scrape NOT done',
                color: 'white',
                background: '#f55426',
                confirmButtonColor: '#030303',
                confirmButtonText: 'OK',
            });
        }
    } catch (error) {
        console.error(error);
    }
});
