<div class="d-flex" style="height: 100vh;">
    <!-- Sidebar (Lebar tetap) -->
    <div class="bg-clr3 overflow-y-scroll scrollbar-hidden flex-shrink-0" style="height:100vh;border-bottom-right-radius:30px;">
        <div class="bg-clr2 py-5" style="height:99vh;border-bottom-right-radius:40px;">
            <div class="menu-resp-text d-flex justify-content-center mx-4">
                <img src="{{ asset('assets/images/static/elements/logo-dashboard.png') }}" style="width:200px;">
            </div>
            <div class="d-flex flex-column justify-content-center mt-5">
                <p class="text-light mb-4 mx-4">MENU</p>
                <a class="mb-2 bg-clr2 td-none p-0 py-3 sidebar-button {{  ($page == 'homepage') ? 'sidebar-active' : '' }}" href="{{url('homepage')}}">
                    <div class="menu-resp-icon d-flex align-items-center mx-4 p-0">
                        <div class="d-flex justify-content-center" style="width:23px;">
                            <img src="{{ asset('assets/images/static/icons/homepage.png') }}" style="height:19px;width:19.4px;">
                        </div>
                        <p class="menu-resp-text text-light m-0 ms-3">Homepage</p>
                    </div>
                </a>
                <a class="mb-2 bg-clr2 td-none p-0 py-3 sidebar-button {{  ($page == '') ? 'sidebar-active' : '' }}" href="{{url('riwayat-presensi')}}">
                    <div class="menu-resp-icon d-flex align-items-center mx-4 p-0">
                        <div class="d-flex justify-content-center" style="width:23px;">
                            <img src="{{ asset('assets/images/static/icons/absensi.png') }}" style="height:22px;width:16px;">
                        </div>
                        <p class="menu-resp-text text-light m-0 ms-3">Riwayat Presensi</p>
                    </div>
                </a>
                <a class="mb-2 bg-clr2 td-none p-0 py-3 sidebar-button {{  ($page == '') ? 'sidebar-active' : '' }}" href="{{url('laporan-lembur')}}">
                    <div class="menu-resp-icon d-flex align-items-center mx-4 p-0">
                        <div class="d-flex justify-content-center" style="width:23px;">
                            <img src="{{ asset('assets/images/static/icons/lembur.png') }}" style="height:22px;width:16px;">
                        </div>
                        <p class="menu-resp-text text-light m-0 ms-3">Laporan Lembur</p>
                    </div>
                </a>
                <a class="mb-2 bg-clr2 td-none p-0 py-3 sidebar-button {{  ($page == '') ? 'sidebar-active' : '' }}" href="{{url('izin-cuti')}}">
                    <div class="menu-resp-icon d-flex align-items-center mx-4 p-0">
                        <div class="d-flex justify-content-center" style="width:23px;">
                            <img src="{{ asset('assets/images/static/icons/cuti.png') }}" style="height:22px;width:16px;">
                        </div>
                        <p class="menu-resp-text text-light m-0 ms-3">Izin Cuti</p>
                    </div>
                </a>
                <a class="mb-2 bg-clr2 td-none p-0 py-3 sidebar-button {{  ($page == '') ? 'sidebar-active' : '' }}" href="{{url('kalender-perusahaan')}}">
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
    <div class="bg-light flex-grow-1" style="height: 100vh;">
        <div class="bg-clr3 d-flex overflow-hidden shadow-l" style="height:8vh;border-bottom-right-radius:30px;">
            <button class="btn btn-transparent text-clr2 fsz-22 mt-1" id="hide-sidebar"><i class="fas fa-bars"></i></button>
            <div class="ms-auto bg-light d-flex align-items-center h-100" style="border-top-left-radius:30px;">
                <div class="mx-3 d-flex align-items-center text-clr2 cursor-pointer">
                    <i class="fas fa-user-circle fsz-16"></i>
                    <p class="m-0 ms-2 d-none d-md-inline">Hi, {{ session('user')['user_nama'] }}</p>
                    <i class="fas fa-chevron-down fsz-10 ms-2"></i>
                </div>
            </div>
        </div>
        <div class="overflow-scroll py-4 px-3" style="height:92vh;">

<style>
.sidebar-button:hover { filter: brightness(80%); }
.sidebar-active { filter: brightness(90%); }
</style>
<script>
document.getElementById("hide-sidebar").addEventListener("click", function () {
    document.querySelectorAll(".menu-resp-text").forEach(function (sidebar) {
        sidebar.classList.toggle("d-none");
    });
    document.querySelectorAll(".menu-resp-icon").forEach(function (icon) {
        icon.classList.toggle("justify-content-center");
    });
});
</script>