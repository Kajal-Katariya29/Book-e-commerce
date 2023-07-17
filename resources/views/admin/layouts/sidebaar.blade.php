<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion" style="background-color: #F88634 !important">
        <div class="sb-sidenav-menu mx-auto">
            <div class="nav">
                <div class="sb-sidenav-menu-heading text-light">NAVIGATION</div>
                <a class="nav-link active" href="{{route('books.index')}}" >
                    <div class="sb-nav-link-icon text-light">
                        <span class="px-1">
                            Book List
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="{{route('categories.index')}}">
                    <div class="sb-nav-link-icon  text-light">
                        <span class="px-1">
                            Categories
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="{{route('variants.index')}}">
                    <div class="sb-nav-link-icon  text-light">
                        <span class="px-1">
                            Variants
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="{{route('variant-type.index')}}">
                    <div class="sb-nav-link-icon  text-light">
                        <span class="px-1">
                            Variant Types
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="{{route('roles.index')}}">
                    <div class="sb-nav-link-icon  text-light">
                        <span class="px-1">
                            Roles
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="{{route('permissions.index')}}">
                    <div class="sb-nav-link-icon  text-light">
                        <span class="px-1">
                            Permissions
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="{{route('role-user.index')}}">
                    <div class="sb-nav-link-icon  text-light">
                        <span class="px-1">
                            Role User
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="{{route('role-permission.index')}}">
                    <div class="sb-nav-link-icon  text-light">
                        <span class="px-1">
                            Role Permission
                        </span>
                    </div>
                </a>
            </div>
        </div>
    </nav>
</div>
<script>
    $(document).ready(function() {
        var currentUrl = window.location.href;
        $(".nav-link").each(function() {
            if ($(this).attr('href') == currentUrl) {
                $(".nav-link").removeClass("active");
                $(".nav-link").css("background-color", "");
                $(this).addClass("active");
                $(this).css("background-color", "white").addClass('rounded shadow ');
                $(this).find("span").css("color", "#F88634");
                $(this).find("i").css("color", "#F88634");
            } else {
                $(this).removeClass("active");
                $(this).css("background-color", "");
                $(this).find("span").css("color", "");
                $(this).find("i").css("color", "");
            }
        });
    });
</script>


