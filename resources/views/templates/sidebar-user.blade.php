<div class="d-block d-md-flex dashboard-content w-100 overflow-hidden" style="height: 100vh;" id="container">
    <!-- Sidebar (Lebar tetap) -->
    <div class="d-none d-md-flex bg-clr3 m-0 sidebar flex-shrink-0" id="sidebar" style="height:100vh;border-bottom-right-radius:30px;">
        <div class="bg-clr2 pt-4 pt-md-5 pb-5 overflow-y-scroll scrollbar-hidden" style="height:99vh;border-bottom-right-radius:40px;">
            <div class="d-flex d-md-none align-items-center ms-3">
                <div class="cursor-pointer text-clr3 fsz-22 hide-sidebar-sm"><i class="fas fa-bars"></i></div>
            </div>
            <div class="menu-resp-text d-flex justify-content-center mx-4">
                <img src="{{ asset('assets/images/static/elements/logo-dashboard.png') }}" style="width:200px;">
            </div>
            <div class="d-flex flex-column justify-content-center mt-5">
                <p class="text-light mb-4 mx-4">MENU</p>
                <a class="mb-2 bg-clr2 td-none p-0 py-3 sidebar-button {{  ($page == 'homepage') ? 'sidebar-active' : '' }}" href="{{url('homepage')}}"
                data-bs-toggle="tooltip" title="Homepage">
                    <div class="menu-resp-icon d-flex align-items-center mx-4 p-0">
                        <div class="d-flex justify-content-center" style="width:23px;">
                            <img src="{{ asset('assets/images/static/icons/homepage.png') }}" style="height:19px;width:19.4px;">
                        </div>
                        <p class="menu-resp-text text-light m-0 ms-3">Homepage</p>
                    </div>
                </a>
                <a class="mb-2 bg-clr2 td-none p-0 py-3 sidebar-button {{  ($page == 'riwayat-presensi') ? 'sidebar-active' : '' }}" href="{{url('riwayat-presensi')}}"
                data-bs-toggle="tooltip" title="Riwayat Presensi">
                    <div class="menu-resp-icon d-flex align-items-center mx-4 p-0">
                        <div class="d-flex justify-content-center" style="width:23px;">
                            <img src="{{ asset('assets/images/static/icons/absensi.png') }}" style="height:22px;width:16px;">
                        </div>
                        <p class="menu-resp-text text-light m-0 ms-3">Riwayat Presensi</p>
                    </div>
                </a>
                <a class="mb-2 bg-clr2 td-none p-0 py-3 sidebar-button {{  ($page == 'lembur') ? 'sidebar-active' : '' }}" href="{{url('laporan-lembur')}}"
                data-bs-toggle="tooltip" title="Laporan Lembur">
                    <div class="menu-resp-icon d-flex align-items-center mx-4 p-0">
                        <div class="d-flex justify-content-center" style="width:23px;">
                            <img src="{{ asset('assets/images/static/icons/lembur.png') }}" style="height:22px;width:16px;">
                        </div>
                        <p class="menu-resp-text text-light m-0 ms-3">Laporan Lembur</p>
                    </div>
                </a>
                <a class="mb-2 bg-clr2 td-none p-0 py-3 sidebar-button {{  ($page == 'cuti') ? 'sidebar-active' : '' }}" href="{{url('izin-cuti')}}"
                data-bs-toggle="tooltip" title="Izin Cuti">
                    <div class="menu-resp-icon d-flex align-items-center mx-4 p-0">
                        <div class="d-flex justify-content-center" style="width:23px;">
                            <img src="{{ asset('assets/images/static/icons/cuti.png') }}" style="height:22px;width:16px;">
                        </div>
                        <p class="menu-resp-text text-light m-0 ms-3">Izin Cuti</p>
                    </div>
                </a>
                <a class="mb-2 bg-clr2 td-none p-0 py-3 sidebar-button {{  ($page == 'kalender') ? 'sidebar-active' : '' }}" href="{{url('kalender-perusahaan')}}"
                data-bs-toggle="tooltip" title="Kalender Perusahaan">
                    <div class="menu-resp-icon d-flex align-items-center mx-4 p-0">
                        <div class="d-flex justify-content-center" style="width:23px;">
                            <img src="{{ asset('assets/images/static/icons/kalender.png') }}" style="height:20px;width:18px;">
                        </div>
                        <p class="menu-resp-text text-light m-0 ms-3">Kalender Perusahaan</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- Konten utama (Mengisi sisa ruang) -->
    <div class="p-0 m-0 flex-grow-1" style="height: 100vh;">
        <div class="bg-clr3 d-flex overflow-hidden shadow-l" style="height:8vh;border-bottom-right-radius:30px;z-index:333;">
            <div class="d-none d-md-flex align-items-center ms-3">
                <div class="cursor-pointer text-clr2 fsz-22" id="hide-sidebar"><i class="fas fa-bars"></i></div>
            </div>
            <div class="d-flex d-md-none align-items-center ms-3">
                <div class="cursor-pointer text-clr2 fsz-22 hide-sidebar-sm"><i class="fas fa-bars"></i></div>
            </div>
            <div class="ms-auto bg-light d-flex align-items-center h-100 btn-group" style="border-top-left-radius:30px;">
                <button class="mx-4 d-flex align-items-center text-clr2 bg-transparent border-none cursor-pointer dropdown-toggle h-100" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle fsz-16"></i>
                    <p class="m-0 ms-2 d-none d-md-inline">Hi, {{ session('user')['user_nama'] }}</p>
                    <!-- <i class="fas fa-chevron-down fsz-10 ms-2"></i> -->
                </button>
                <ul class="dropdown-menu dropdown-menu-end dropdown-profile position-fixed mt-1 rounded-s bg-clrsec" style="width:280px;z-index:5;">
                    <li class="d-flex flex-column justify-content-center py-3 px-4 text-clr2">
                        @if(session('user')['user_foto'] !== null)
                        @else
                            <i class="fas fa-user-circle fsz-40 text-center"></i>
                            <p class="mt-3 m-0 text-center fw-bold">{{ session('user')['user_nama'] }}</p>
                        @endif
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-clr2 py-2" href="{{ url('profil-saya') }}"><i class="fas fa-user-circle me-2"></i>Profil Saya</a></li>
                    <li><a class="dropdown-item text-danger py-2" href="{{ url('logout') }}"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="mt-1 m-0 p-0 overflow-y-scroll overflow-x-hidden" style="height:92vh;">
            <div class="m-0 p-3 mt-5 mt-md-3">

<style>
.sidebar-button:hover { filter: brightness(80%); }
.sidebar-active { filter: brightness(90%); }
.dropdown-profile { border: 1px solid rgb(157, 161, 165); border-top-right-radius: 3px; }
.dropdown-profile::before, .dropdown-profile::after { position: absolute; right: 0; display: inline-block; content: ''; }
.dropdown-profile::before { top: -30px; border-right: 10px solid transparent; border-bottom: 30px solid #6c757d; border-left: 10px solid transparent; z-index: -1; }
.dropdown-profile::after { top: -27px; border-right: 10px solid transparent; border-bottom: 28px solid var(--clrsec); border-left: 10px solid transparent; }
</style>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const hideSidebarBtn = document.getElementById("hide-sidebar");
    function toggleSidebar() {
        const isHidden = sessionStorage.getItem("sidebarHidden") === "true";
        sessionStorage.setItem("sidebarHidden", !isHidden);
        updateSidebarUI();
    }
    function updateSidebarUI() {
        const isHidden = sessionStorage.getItem("sidebarHidden") === "true";
        document.querySelectorAll(".menu-resp-text").forEach(sidebar => {
            sidebar.classList.toggle("d-none", isHidden);
        });
        document.querySelectorAll(".menu-resp-icon").forEach(icon => {
            icon.classList.toggle("justify-content-center", isHidden);
        });
    }
    function resetSessionOnResize() {
        sessionStorage.removeItem("sidebarHidden");
        updateSidebarUI();
    }
    hideSidebarBtn.addEventListener("click", toggleSidebar);
    window.addEventListener("resize", resetSessionOnResize);
    updateSidebarUI();
});

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".hide-sidebar-sm").forEach(function (button) {
        button.addEventListener("click", function () {
            let sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("d-none");
            sidebar.classList.toggle("d-block");
        });
    });
});
</script>