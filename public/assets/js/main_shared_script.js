var navColorKey = "NavbarColorVariants",
    accentColorKey = "AccentColorVariants",
    darkSidebarKey = "DarkSidebarVariants",
    lightSidebarKey = "LightSidebarVariants",
    SidebarCollapsed = "SidebarCollapsed",
    SidebarMini = "SidebarMini",
    SidebarMiniMD = "SidebarMiniMD",
    SidebarMiniXS = "SidebarMiniXS",
    NavFlatStyle = "NavFlatStyle",
    NavLegacyStyle = "NavLegacyStyle",
    NavCompact = "NavCompact",
    NavChildHideOnCollapse = "NavChildHideOnCollapse",
    DisableHover_FocusAuto_Expand = "DisableHover_FocusAuto_Expand",
    TextSmBody = "TextSmBody",
    TextSmNavbar = "TextSmNavbar",
    TextSmSidebarNav = "TextSmSidebarNav",
    TextSmFooter = "TextSmFooter";
// Color Arrays
var navbar_dark_skins = [
    'navbar-primary',
    'navbar-secondary',
    'navbar-info',
    'navbar-success',
    'navbar-danger',
    'navbar-indigo',
    'navbar-purple',
    'navbar-pink',
    'navbar-navy',
    'navbar-lightblue',
    'navbar-teal',
    'navbar-cyan',
    'navbar-dark',
    'navbar-gray-dark',
    'navbar-gray'
]
var navbar_light_skins = [
    'navbar-light',
    'navbar-warning',
    'navbar-white',
    'navbar-orange'
]
var sidebar_colors = [
    'bg-primary',
    'bg-warning',
    'bg-info',
    'bg-danger',
    'bg-success',
    'bg-indigo',
    'bg-lightblue',
    'bg-navy',
    'bg-purple',
    'bg-fuchsia',
    'bg-pink',
    'bg-maroon',
    'bg-orange',
    'bg-lime',
    'bg-teal',
    'bg-olive'
]
var accent_colors = [
    'accent-primary',
    'accent-warning',
    'accent-info',
    'accent-danger',
    'accent-success',
    'accent-indigo',
    'accent-lightblue',
    'accent-navy',
    'accent-purple',
    'accent-fuchsia',
    'accent-pink',
    'accent-maroon',
    'accent-orange',
    'accent-lime',
    'accent-teal',
    'accent-olive'
]
var sidebar_skins = [
    'sidebar-dark-primary',
    'sidebar-dark-warning',
    'sidebar-dark-info',
    'sidebar-dark-danger',
    'sidebar-dark-success',
    'sidebar-dark-indigo',
    'sidebar-dark-lightblue',
    'sidebar-dark-navy',
    'sidebar-dark-purple',
    'sidebar-dark-fuchsia',
    'sidebar-dark-pink',
    'sidebar-dark-maroon',
    'sidebar-dark-orange',
    'sidebar-dark-lime',
    'sidebar-dark-teal',
    'sidebar-dark-olive',
    'sidebar-light-primary',
    'sidebar-light-warning',
    'sidebar-light-info',
    'sidebar-light-danger',
    'sidebar-light-success',
    'sidebar-light-indigo',
    'sidebar-light-lightblue',
    'sidebar-light-navy',
    'sidebar-light-purple',
    'sidebar-light-fuchsia',
    'sidebar-light-pink',
    'sidebar-light-maroon',
    'sidebar-light-orange',
    'sidebar-light-lime',
    'sidebar-light-teal',
    'sidebar-light-olive'
];

function getStorageValue(key, def = null) {
    var k = getStorage(key).get();
    return (k) ? k.toString() : def;
}

function setStorageValue(key, val) {
    getStorage(key).put(val);
}

function getStorage(a) {
    var a = 'MedicalWebSite_' + a;
    return {
        get: function() {
            return (localStorage[a]) ? localStorage[a] : null;
        },
        put: function(e) {
            localStorage[a] = e;
        }
    }
}

function FillDarkMode(t) {
    var $btn = $(t);
    var mod = $btn.attr("mode");
    if (mod === 'dark-mode') {
        mod = 'light-mode';
        $btn.html('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="-rotate-90"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>');
    } else {
        mod = 'dark-mode';
        $btn.html('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>');
    }
    $btn.attr("mode", mod);
    $('body').addClass(mod);
    getStorage("DarkMode").put(mod);
}

function CheckDarkMode(t) {
    $('body').removeClass('dark-mode');
    $('body').removeClass('light-mode');
    FillDarkMode(t);
}

function getDarkMode() {
    var k = getStorage("DarkMode").get();
    var mod = (!k) ? 'dark-mode' : (k === 'dark-mode') ? 'light-mode' : 'dark-mode';
    return mod;
}

function changeOptionsThemeClass(tag, ref, clas) {
    var val = getStorageValue(tag, '');
    if (val === 'checked')
        $(ref).addClass(clas)
}

function getNavColorKeyClass() {
    var color = getStorageValue(navColorKey, "bg-primary");
    var nav_color = color.replace('bg-', 'navbar-')
    var $main_header = $('.main-header');
    var navbar_all_colors = navbar_dark_skins.concat(navbar_light_skins)
    navbar_all_colors.forEach(function(clor) {
        $main_header.removeClass(clor)
    })
    if (navbar_dark_skins.indexOf(nav_color) > -1)
        $main_header.addClass('navbar-dark')
    else
        $main_header.addClass('navbar-light')
    $main_header.addClass(nav_color)
}

function getAccentColorClass() {
    var color = getStorageValue(accentColorKey, "bg-primary").replace('bg-', 'accent-');
    var $body = $('body')
    accent_colors.forEach(function(skin) {
        $body.removeClass(skin)
    })
    $body.addClass(color)
}

function getSidebarColorClass() {
    var lightSidebarColor = getStorageValue(lightSidebarKey, null),
        darkSidebarColor = getStorageValue(darkSidebarKey, 'bg-primary');
    var $sidebar = $('.main-sidebar');
    sidebar_skins.forEach(function(skin) {
        $sidebar.removeClass(skin)
    })
    var sidebar_class = '';
    if (!(!darkSidebarColor || darkSidebarColor === null || darkSidebarColor === 'null'))
        sidebar_class = 'sidebar-dark-' + darkSidebarColor.replace('bg-', '')
    else
        sidebar_class = 'sidebar-light-' + lightSidebarColor.replace('bg-', '')
    $sidebar.addClass(sidebar_class)
}

function initMainTheme() {
    getNavColorKeyClass();
    getAccentColorClass();
    getSidebarColorClass();
    if ($("body").attr('dir') === 'rtl')
        $('#sidebar-nav').find('i.right').removeClass('right').addClass('left');
    else
        $('#sidebar-nav').find('i.left').removeClass('left').addClass('right');
    var $dark_btn = $('<button />', {
        type: 'button',
        class: 'btn btn-sm color-mode'
    }).on('click', function() {
        CheckDarkMode($(this));
    });
    if ($("#dark-container"))
        $("#dark-container").append($dark_btn);
    changeOptionsThemeClass(SidebarCollapsed, 'body', 'sidebar-collapse');
    changeOptionsThemeClass(SidebarMini, 'body', 'sidebar-mini');
    changeOptionsThemeClass(SidebarMiniMD, 'body', 'sidebar-mini-md');
    changeOptionsThemeClass(SidebarMiniXS, 'body', 'sidebar-mini-xs');
    changeOptionsThemeClass(NavFlatStyle, '.nav-sidebar', 'nav-flat');
    changeOptionsThemeClass(NavLegacyStyle, '.nav-sidebar', 'nav-legacy');
    changeOptionsThemeClass(NavCompact, '.nav-sidebar', 'nav-compact');
    changeOptionsThemeClass(NavChildHideOnCollapse, '.nav-sidebar', 'nav-collapse-hide-child');
    changeOptionsThemeClass(DisableHover_FocusAuto_Expand, '.main-sidebar', 'sidebar-no-expand');
    changeOptionsThemeClass(TextSmBody, '.content-wrapper', 'text-sm');
    changeOptionsThemeClass(TextSmNavbar, '.main-header', 'text-sm');
    changeOptionsThemeClass(TextSmSidebarNav, '.nav-sidebar', 'text-sm');
    changeOptionsThemeClass(TextSmFooter, '.main-footer', 'text-sm');
    var mod = getDarkMode();
    $dark_btn.attr("mode", mod);
    CheckDarkMode($dark_btn);
};
$(function() {
    initMainTheme();
});