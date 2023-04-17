const form = document.querySelector('form');
form.addEventListener('submit', async (event) => {
    event.preventDefault(); // Prevents the default form submission

    const formData = new FormData(form);
    const url = form.action;

    try {
        await Swal.showLoading();
        const response = await axios.post(url, formData);
        const { success } = response.data;

        if (success) {
            await Swal.fire({
                title: 'Message send successfully',
                color: 'white',
                background: '#374151',
                confirmButtonColor: '#111827',
                confirmButtonText: 'OK',
            });

        } else {
            await Swal.fire({
                title: 'Message NOT send',
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
