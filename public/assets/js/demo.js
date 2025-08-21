(function ($) {
    'use strict'

    var changeElementClass = function (el, ref, clas) {
            if ($(el).is(':checked')) {
                $(ref).addClass(clas)
            } else {
                $(ref).removeClass(clas)
            }
        },
        capitalizeFirstLetter = function (string) {
            return string.charAt(0).toUpperCase() + string.slice(1)
        },
        addDefaultOption = function (parent) {
            if (parent.find('option[data-val="empty"]').length == 0) {
                if (parent.children('option').length > 0)
                    getEmptyOption().insertBefore(parent.children('option').first())
                else
                    parent.append(getEmptyOption());
            }
        },
        getEmptyOption = function () {
            var $def = $('<option />', {
                text: SidebarTrans.NoneSelected,
                data: 'empty'
            })
            $def.attr("data-val", "empty")
            return $def;
        },
        createSkinBlock = function (colors, title, container, slclr, callback) {
            container.append('<h6>' + title + '</h6>')
            var noneSel = (!slclr || slclr === null || slclr === 'null')
            var $block = $('<select/>', {
                class: noneSel ? 'custom-select mb-3 border-0' : 'custom-select mb-3 text-light border-0 ' + slclr.replace(/accent-|navbar-/, 'bg-')
            })
            if (noneSel)
                addDefaultOption($block)
            colors.forEach(function (color) {
                var $color = $('<option />', {
                    class: (typeof color === 'object' ? color.join(' ') : color).replace('navbar-', 'bg-').replace('accent-', 'bg-'),
                    text: capitalizeFirstLetter((typeof color === 'object' ? color.join(' ') : color).replace(/navbar-|accent-|bg-/, '').replace('-', ' '))
                })
                $block.append($color)
            })
            if (!noneSel)
                $block.find('option.' + slclr).prop('selected', true)
            var $parent = $('<div />', {
                class: 'd-flex'
            })
            $parent.append($block)
            container.append($parent)
            if (callback)
                $block.on('change', callback)
            return $block
        },
        createTrSkinBlock = function (colors, title, container, slclr, callback) {
            var $block = createSkinBlock(colors, title, container, slclr, callback)
            if (!(!slclr || slclr === null || slclr === 'null'))
                $block.trigger('change')
            return $block;
        };



    var createCheckboxItems = function (checked, id, title, container, callback) {
        var $block = $('<input />', {
            type: 'checkbox',
            id: id,
            class: 'custom-control-input'
        })
        var $parent = $('<div />', {
            class: 'custom-control custom-checkbox'
        })
        $parent.append($block)
        $parent.append('<label for="' + id + '" class="custom-control-label">' + title + '</label>')
        container.append($parent)
        $block.prop('checked', checked)
        if (callback) {
            $block.on('change', callback)
            $block.trigger('change')
        }
        return $block
    }
    var $themeSettings1 = $('#theme-settings-1')
    var $op = $('<div class="card card-primary"> <div class="card-header text-center"> <h5 class="card-title"> ' + SidebarTrans.SidebarOptions + '</h5> </div> <div class="card-body"> </div></div>');
    $themeSettings1.append($op)
    var $sidebarOptions = $op.find('div.card-body');
    createCheckboxItems(getStorageValue(SidebarCollapsed, $('body').hasClass('sidebar-collapse')), 'Option1', SidebarTrans.Collapsed, $sidebarOptions, function () {
        var val = ($(this).is(':checked')) ? 'checked' : '';
        setStorageValue(SidebarCollapsed, val);
        changeElementClass(this, 'body', 'sidebar-collapse');
        $(window).trigger('resize')
    });
    $(document).on('collapsed.lte.pushmenu', '[data-widget="pushmenu"]', function () {
        $('#Option1').prop('checked', true)
    })
    $(document).on('shown.lte.pushmenu', '[data-widget="pushmenu"]', function () {
        $('#Option1').prop('checked', false)
    })
    //SidebarMini
    createCheckboxItems(getStorageValue(SidebarMini, ''), 'Option2', SidebarTrans.SidebarMini, $sidebarOptions, function () {
        var val = ($(this).is(':checked')) ? 'checked' : '';
        setStorageValue(SidebarMini, val);
        changeElementClass(this, 'body', 'sidebar-mini');
    });
    createCheckboxItems(getStorageValue(SidebarMiniMD, ''), 'Option3', SidebarTrans.SidebarMiniMD, $sidebarOptions, function () {
        var val = ($(this).is(':checked')) ? 'checked' : '';
        setStorageValue(SidebarMiniMD, val);
        changeElementClass(this, 'body', 'sidebar-mini-md');
    });
    createCheckboxItems(getStorageValue(SidebarMiniXS, ''), 'Option4', SidebarTrans.SidebarMiniXS, $sidebarOptions, function () {
        var val = ($(this).is(':checked')) ? 'checked' : '';
        setStorageValue(SidebarMiniXS, val);
        changeElementClass(this, 'body', 'sidebar-mini-xs');
    });
    createCheckboxItems(getStorageValue(NavFlatStyle, ''), 'Option5', SidebarTrans.NavFlatStyle, $sidebarOptions, function () {
        var val = ($(this).is(':checked')) ? 'checked' : '';
        setStorageValue(NavFlatStyle, val);
        changeElementClass(this, '.nav-sidebar', 'nav-flat');
    });
    createCheckboxItems(getStorageValue(NavLegacyStyle, ''), 'Option6', SidebarTrans.NavLegacyStyle, $sidebarOptions, function () {
        var val = ($(this).is(':checked')) ? 'checked' : '';
        setStorageValue(NavLegacyStyle, val);
        changeElementClass(this, '.nav-sidebar', 'nav-legacy');
    });
    createCheckboxItems(getStorageValue(NavCompact, ''), 'Option7', SidebarTrans.NavCompact, $sidebarOptions, function () {
        var val = ($(this).is(':checked')) ? 'checked' : '';
        setStorageValue(NavCompact, val);
        changeElementClass(this, '.nav-sidebar', 'nav-compact');
    });
    createCheckboxItems(getStorageValue(NavChildHideOnCollapse, ''), 'Option8', SidebarTrans.NavChildHideOnCollapse, $sidebarOptions, function () {
        var val = ($(this).is(':checked')) ? 'checked' : '';
        setStorageValue(NavChildHideOnCollapse, val);
        changeElementClass(this, '.nav-sidebar', 'nav-collapse-hide-child');
    });
    createCheckboxItems(getStorageValue(DisableHover_FocusAuto_Expand, ''), 'Option9', SidebarTrans.DisableHover_FocusAuto_Expand, $sidebarOptions, function () {
        var val = ($(this).is(':checked')) ? 'checked' : '';
        setStorageValue(DisableHover_FocusAuto_Expand, val);
        changeElementClass(this, '.main-sidebar', 'sidebar-no-expand');
    });
    var $themeSettings2 = $('#theme-settings-2')
    var $op = $('<div class="card card-primary"> <div class="card-header text-center"> <h5 class="card-title"> ' + SidebarTrans.SmallTextOptions + '</h5> </div> <div class="card-body"> </div></div>');
    $themeSettings2.append($op)
    var $smallTextOptions = $op.find('div.card-body');
    createCheckboxItems(getStorageValue(TextSmBody, ''), 'Option10', SidebarTrans.Body, $smallTextOptions, function () {
        var val = ($(this).is(':checked')) ? 'checked' : '';
        setStorageValue(TextSmBody, val);
        changeElementClass(this, '.content-wrapper', 'text-sm');
    });
    createCheckboxItems(getStorageValue(TextSmNavbar, ''), 'Option11', SidebarTrans.Navbar, $smallTextOptions, function () {
        var val = ($(this).is(':checked')) ? 'checked' : '';
        setStorageValue(TextSmNavbar, val);
        changeElementClass(this, '.main-header', 'text-sm');
    });
    createCheckboxItems(getStorageValue(TextSmSidebarNav, ''), 'Option12', SidebarTrans.SidebarNav, $smallTextOptions, function () {
        var val = ($(this).is(':checked')) ? 'checked' : '';
        setStorageValue(TextSmSidebarNav, val);
        changeElementClass(this, '.nav-sidebar', 'text-sm');
    });
    createCheckboxItems(getStorageValue(TextSmFooter, ''), 'Option13', SidebarTrans.Footer, $smallTextOptions, function () {
        var val = ($(this).is(':checked')) ? 'checked' : '';
        setStorageValue(TextSmFooter, val);
        changeElementClass(this, '.main-footer', 'text-sm');
    });
    // Navbar Variants
    var $themeSettings3 = $('#theme-settings-3')
    var $op = $('<div class="card card-primary"> <div class="card-header text-center"> <h5 class="card-title">' + SidebarTrans.ColorVariants + ' </h5> </div> <div class="card-body"> </div></div>');
    $themeSettings3.append($op)
    var $variantsBody = $op.find('div.card-body');
    var navbar_all_colors = navbar_dark_skins.concat(navbar_light_skins)
    createTrSkinBlock(navbar_all_colors, "Navbar Variants", $variantsBody, getStorageValue(navColorKey, "bg-primary"), function () {
        var color = $(this).find('option:selected').attr('class')
        var nav_color = color.replace('bg-', 'navbar-')
        var $main_header = $('.main-header')
        $main_header.removeClass('navbar-dark').removeClass('navbar-light')
        navbar_all_colors.forEach(function (clor) {
            $main_header.removeClass(clor)
        })
        $(this).removeClass().addClass('custom-select mb-3 text-light border-0 ')
        if (navbar_dark_skins.indexOf(nav_color) > -1) {
            $main_header.addClass('navbar-dark')
            $(this).addClass(color).addClass('text-light')
        } else {
            $main_header.addClass('navbar-light')
            $(this).addClass(color)
        }
        $main_header.addClass(nav_color)
        setStorageValue(navColorKey, color)
    })
    // Sidebar Colors
    createTrSkinBlock(accent_colors, 'Accent Color Variants', $variantsBody, getStorageValue(accentColorKey, 'bg-primary'), function () {
        var color = $(this).find('option:selected').attr('class')
        var $body = $('body')
        accent_colors.forEach(function (skin) {
            $body.removeClass(skin)
        })
        $(this).removeClass().addClass('custom-select mb-3 text-light border-0 ')
        $(this).addClass(color);
        var accent_color_class = color.replace('bg-', 'accent-')
        $body.addClass(accent_color_class)
        setStorageValue(accentColorKey, color)
    })
    var lightSidebarColor = getStorageValue(lightSidebarKey, null),
        darkSidebarColor = getStorageValue(darkSidebarKey, null)
    var $sidebar_dark_variants = createSkinBlock(sidebar_colors, 'Dark Sidebar Variants', $variantsBody, darkSidebarColor, function () {
        var color = $(this).find('option:selected').attr('class')
        if (!color)
            return;
        var sidebar_class = 'sidebar-dark-' + color.replace('bg-', '')
        var $sidebar = $('.main-sidebar')
        var $control_sidebar = $('.control-sidebar')
        sidebar_skins.forEach(function (skin) {
            $sidebar.removeClass(skin)
            $control_sidebar.removeClass(skin)
            if ($sidebar_light_variants)
                $sidebar_light_variants.removeClass(skin.replace('sidebar-dark-', 'bg-')).removeClass('text-light')
        })
        $(this).removeClass().addClass('custom-select mb-3 text-light border-0').addClass(color)
        if ($sidebar_light_variants)
            $sidebar_light_variants.find('option').prop('selected', false)
        $sidebar.addClass(sidebar_class)
        $control_sidebar.addClass(sidebar_class).addClass('text-light')
        $('.sidebar').removeClass('os-theme-dark').addClass('os-theme-light')
        setStorageValue(darkSidebarKey, color)
        setStorageValue(lightSidebarKey, null)
    })
    var $sidebar_light_variants = createSkinBlock(sidebar_colors, 'Light Sidebar Variants', $variantsBody, lightSidebarColor, function () {
        var color = $(this).find('option:selected').attr('class')
        if (!color)
            return;
        var sidebar_class = 'sidebar-light-' + color.replace('bg-', '')
        var $sidebar = $('.main-sidebar')
        var $control_sidebar = $('.control-sidebar')
        sidebar_skins.forEach(function (skin) {
            $sidebar.removeClass(skin)
            $control_sidebar.removeClass(skin)
            $sidebar_dark_variants.removeClass(skin.replace('sidebar-light-', 'bg-')).removeClass('text-light')
        })
        $(this).removeClass().addClass('custom-select mb-3 text-light border-0').addClass(color)
        $sidebar_dark_variants.find('option').prop('selected', false)
        $sidebar.addClass(sidebar_class)
        $control_sidebar.addClass(sidebar_class).removeClass('text-light')
        $('.sidebar').removeClass('os-theme-light').addClass('os-theme-dark')
        setStorageValue(lightSidebarKey, color)
        setStorageValue(darkSidebarKey, null)
    })
    addDefaultOption($sidebar_dark_variants)
    addDefaultOption($sidebar_light_variants)
    if (!(darkSidebarColor === null || darkSidebarColor === 'null'))
        $sidebar_dark_variants.trigger('change')
    $sidebar_light_variants.trigger('change')
})(jQuery)
