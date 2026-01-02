@if (session('show_welcome_modal'))
    <div id="welcome-modal"
        class="fixed inset-0 z-[999] flex items-center justify-center px-4 py-6 sm:px-0 transition-opacity duration-300 opacity-0 pointer-events-none">

        <div id="welcome-backdrop"
            class="absolute inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm transition-opacity duration-300 ease-out">
        </div>

        <div id="welcome-card"
            class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 transform transition-all duration-300 ease-out scale-95 opacity-0"
            role="dialog" aria-modal="true">

            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-indigo-50 mb-5">
                    <i class="fa-solid fa-school text-2xl text-indigo-600"></i>
                </div>

                <h2 class="text-xl font-bold text-gray-900 mb-2">
                    Selamat Datang!
                </h2>

                <p class="text-sm text-gray-600 leading-relaxed mb-6">
                    Aplikasi <strong>Aspirasi Siswa</strong> hadir untuk menjembatani suara Anda demi kemajuan dan
                    transparansi sekolah yang lebih baik.
                </p>

                <div class="border-t border-gray-100 pt-4 mb-6">
                    <a href="https://onlinekan.netlify.app/" target="_blank"
                        class="group inline-flex items-center justify-center space-x-2 text-xs text-gray-500 hover:text-indigo-600 transition-colors duration-200">
                        <span>Powered by</span>
                        <span class="font-bold flex items-center">
                            <i class="fa-solid fa-bolt text-yellow-500 mr-1"></i> Onlinekan Service
                        </span>
                    </a>
                </div>

                <button id="close-welcome-btn" type="button"
                    class="w-full inline-flex justify-center items-center px-4 py-3 bg-indigo-600 border border-transparent rounded-xl font-semibold text-white text-sm uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-indigo-200">
                    Mulai Jelajahi
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalWrapper = document.getElementById('welcome-modal');
            const modalCard = document.getElementById('welcome-card');
            const closeBtn = document.getElementById('close-welcome-btn');

            if (modalWrapper && modalCard && closeBtn) {
                setTimeout(() => {
                    modalWrapper.classList.remove('opacity-0', 'pointer-events-none');

                    modalCard.classList.remove('scale-95', 'opacity-0');
                    modalCard.classList.add('scale-100', 'opacity-100');
                }, 50);

                closeBtn.addEventListener('click', function() {
                    modalCard.classList.remove('scale-100', 'opacity-100');
                    modalCard.classList.add('scale-95', 'opacity-0');

                    modalWrapper.classList.add('opacity-0');
                    modalWrapper.classList.add('pointer-events-none');

                    setTimeout(() => {
                        modalWrapper.remove();
                    }, 300);
                });
            }
        });
    </script>
@endif
