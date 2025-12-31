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
