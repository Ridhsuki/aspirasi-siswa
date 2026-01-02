function updateCharCount(textarea) {
    const maxLength = 500;
    const currentLength = textarea.value.length;
    const counter = document.getElementById('charCount');

    counter.textContent = `${currentLength}/${maxLength}`;

    if (currentLength > 450) {
        counter.classList.add('warning');
    } else {
        counter.classList.remove('warning');
    }
}

document.addEventListener('DOMContentLoaded', () => {
    document.body.addEventListener('submit', function (e) {
        const form = e.target;
        if (form.classList.contains('delete-confirm')) {
            e.preventDefault();
            const customText = form.dataset.confirmText;
            const defaultText = "Data yang dihapus tidak dapat dikembalikan!";

            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: customText || defaultText,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            } else {
                if (confirm(customText || defaultText)) {
                    form.submit();
                }
            }
        }
    });
});
