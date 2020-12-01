<div class="main-header">
            <div class="logo">
                <img src="<?=base_url()?>/public/assets/images/sssss.png" alt="">
            </div>

            <div class="menu-toggle">
                <div></div>
                <div></div>
                <div></div>
            </div>
 

            <div style="margin: auto"></div>

            <div class="header-part-right">
                <div class="dropdown">
                    <div class="user colalign-self-end" style="    width: 40px;height: 40px;border-radius: 50%;background: #e0e0e0;">
                        <i style="font-size: 22px;width: 40px;margin: 9px;line-height: 1.6;" class="i-Boy"></i>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <div class="dropdown-header">
                                <i class="i-Lock-User mr-1"></i> Timothy Carlson
                            </div>
                            <a class="dropdown-item" href="<?=base_url()?>login/logout">Sign out</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="side-content-wrap">
            <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
                <ul class="navigation-left">
                    <li class="nav-item">
                        <a class="nav-item-hold" href="<?=base_url()?>">
                            <i class="nav-icon i-Home-4"></i>
                            <span class="nav-text">Anasayfa</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item" data-item="seller">
                        <a class="nav-item-hold" href="#">
                            <i class="nav-icon i-Library"></i>
                            <span class="nav-text">Bayi Yönetimi</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item" data-item="setting">
                        <a class="nav-item-hold" href="#">
                            <i class="nav-icon i-Suitcase"></i>
                            <span class="nav-text">Ayarlar</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                </ul>
            </div>

            <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
               
                <ul class="childNav" data-parent="setting">
                <li class="nav-item">
                        <a href="#">
                            <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                            <span class="item-name">Sistem Ayarları</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=base_url()?>/user/index">
                            <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                            <span class="item-name">Kullanıcılar</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=base_url()?>/settings/iyzico">
                            <i class="nav-icon i-Split-Vertical"></i>
                            <span class="item-name">İyzico</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=base_url()?>/settings/pos">
                            <i class="nav-icon i-Split-Vertical"></i>
                            <span class="item-name">Pos Yönetimi</span>
                        </a>
                    </li>
                </ul>

                <ul class="childNav" data-parent="seller">
                    <li class="nav-item">
                        <a href="<?=base_url()?>/home/seller">
                            <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                            <span class="item-name">Bayi Listesi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=base_url()?>/home/sellerPaymentList">
                            <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                            <span class="item-name">Bayi Ödeme Listesi</span>
                        </a>
                    </li>

                </ul>
          
            </div>
            <div class="sidebar-overlay"></div>
        </div>
        <!--=============== Left side End ================-->
