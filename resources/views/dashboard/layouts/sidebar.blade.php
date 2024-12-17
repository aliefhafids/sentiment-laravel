<div id="sidebar">
    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li id="menu-dashboard" class="menu-item">
            <a href="/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboards">Dashboards</div>
                <div class="badge bg-danger rounded-pill ms-auto">!</div>
            </a>
        </li>

        <!-- Layouts -->
        <li id="menu-data" class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Data</div>
            </a>

            <ul class="menu-sub">
                <li id="menu-data-latih" class="menu-item">
                    <a href="/dashboard/dataset" class="menu-link">
                        <div data-i18n="Data latih">Dataset</div>
                    </a>
                </li>
                <li id="menu-data-latih" class="menu-item">
                    <a href="/dashboard/latih" class="menu-link">
                        <div data-i18n="Data latih">Data Latih</div>
                    </a>
                </li>
                <li id="menu-data-uji" class="menu-item">
                    <a href="/dashboard/uji" class="menu-link">
                        <div data-i18n="Data uji">Data Uji</div>
                    </a>
                </li>
            </ul>
        </li>
        <li id="menu-klasifikasi" class="menu-item">
            <a href="/dashboard/klasifikasi" class="menu-link">
                <i class="menu-icon tf-icons bx bx-chat"></i>
                <div data-i18n="Klasifikasi">Klasifikasi</div>
            </a>
        </li>
        <li id="menu-hasil-analisis" class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Layouts">Hasil Analisis</div>
            </a>

            <ul class="menu-sub">
                <li id="menu-hasil-tf" class="menu-item">
                    <a href="/api/dashboard/process" class="menu-link">
                        <div data-i18n="Hasil TF">Hasil Preprocessing</div>
                    </a>
                </li>
                <li id="menu-hasil-klasifikasi" class="menu-item">
                    <a href="/dashboard/classification/results" class="menu-link">
                        <div data-i18n="Hasil Klasifikasi">Hasil Klasifikasi</div>
                    </a>
                </li>
                <li id="menu-hasil-klasifikasi" class="menu-item">
                    <a href="/api/dashboard/frekuensi" class="menu-link">
                        <div data-i18n="Hasil Klasifikasi">Hasil Frekuensi Kata</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
