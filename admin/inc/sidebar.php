<div class="grid_2">
    <div class="box sidemenu">
        <div class="block" id="section-menu">
            <ul class="section menu">
                <style>
                    /* Mục cha mặc định */
                    .menuitem {
                        font-weight: bold;
                        /* Đặt độ đậm cho mục cha */
                    }

                    /* Mục cha khi hover */
                    .menuitem:hover {
                        background-color: #f0f0f0;
                        /* Màu nền khi hover */
                        font-weight: bold;
                        /* Đặt độ đậm khi hover */
                    }

                    /* Ẩn submenu ban đầu */
                    .submenu {
                        display: none;
                    }

                    /* Hiển thị submenu khi .active được thêm vào */
                    .menuitem.active .submenu {
                        display: block;
                    }
                </style>

                <!-- <li><a class="menuitem">Danh mục sản phẩm</a>
                    <ul class="submenu">
                        <li><a href="catadd.php">Thêm danh mục</a> </li>
                        <li><a href="catlist.php">Danh mục sản phẩm</a> </li>
                    </ul>
                </li> -->

                <li class="menuitem">
                    <a href="#" class="toggle-submenu">Quản lý danh mục</a>
                    <ul class="submenu">
                        <li><a href="catadd.php">Thêm danh mục</a></li>
                        <li><a href="catlist.php">Danh sách danh mục</a></li>
                    </ul>
                </li>

                <li class="menuitem">
                    <a href="#" class="toggle-submenu"> Quản lý sản phẩm</a>
                    <ul class="submenu">
                        <li><a href="productadd.php">Thêm sản phẩm</a></li>
                        <li><a href="productlist.php">Danh sách sản phẩm</a></li>
                    </ul>
                </li>

                <li class="menuitem">
                    <a href="#" class="toggle-submenu">Khách hàng</a>
                    <ul class="submenu">
                        <li><a href="customerlist.php">Danh sách khách hàng</a></li>
                    </ul>
                </li>


                <li class="menuitem">
                    <a href="#" class="toggle-submenu">Hóa đơn</a>
                    <ul class="submenu">
                        <li><a href="inbox.php">Danh sách hóa đơn</a></li>
                    </ul>
                </li>


                <!-- <li><a class="menuitem">Sản phẩm</a>
                    <ul class="submenu">
                        <li><a href="productadd.php">Thêm sản phẩm</a> </li>
                        <li><a href="productlist.php">Danh sách sản phẩm</a> </li>
                    </ul>
                </li> -->

                <!-- <li><a class="menuitem">Thương hiệu sản phẩm</a>
                    <ul class="submenu">
                        <li><a href="brandadd.php">Thêm thương hiệu</a> </li>
                        <li><a href="brandlist.php">Danh sách thương hiệu</a> </li>
                    </ul>
                </li> -->




                <!-- <li><a class="menuitem">Site Option</a>
                    <ul class="submenu">
                        <li><a href="titleslogan.php">Title & Slogan</a></li>
                        <li><a href="social.php">Social Media</a></li>
                        <li><a href="copyright.php">Copyright</a></li>

                    </ul>
                </li>

                <li><a class="menuitem">Update Pages</a>
                    <ul class="submenu">
                        <li><a>About Us</a></li>
                        <li><a>Contact Us</a></li>
                    </ul>
                </li>
                <li><a class="menuitem">Slider Option</a>
                    <ul class="submenu">
                        <li><a href="addslider.php">Add Slider</a> </li>
                        <li><a href="sliderlist.php">Slider List</a> </li>
                    </ul>
                </li> -->


            </ul>
        </div>
    </div>
</div>