# silverstripe-elemental-base
Silverstripe Elemental Alternate Base

# Usage

elements.yml:

    ---
    Name: myelements
    After: silverstripe-elemental-textimage
    ---
    Page:
      extensions:
      - ATW\ElementalBase\Extensions\ElementalPageExtension
      ATW\ElementalTextImage\Models\ElementTextImage:
        variants:
          section--imageleft: 'Image Left'
          section--imageright: 'Image Right'
        variants_name: 'Image direction'
      ATW\ElementalBase\Models\ElementText:
        options:
          section--highlight: 'Highlight'
        options_name: 'Options'
    ATW\ElementalBase\Models\BaseElement:
      use_submenu: false

# Options and Variants

Variants and options can be defined in the config. 
They are displayed in the CMS as dropdown (Variants)
and checkboxes (Options).

They can be included in the template. 

ElementTextImage.ss:

    <section class="section section--textimage $VariantClasses" id="$Anchor">
        <div class="section_content">
            <% if $ShowTitle %>
                <h2>$Title</h2>
            <% end_if %>
            <div class="section_items">
                <div class="text">
                    $Text
                </div>
    
                <div class="image">
                    $Image
                </div>
    
            </div>
        </div>
    </section>

# Submenu

For the generation of anchor menus:

    ATW\ElementalBase\Models\BaseElement:
      use_submenu: true

Displays title and option for the submenu in the CMS.

In the template:

    <% if $SubMenu %>
    <ul class="submenu">
        <% loop $SubMenu %>
        <li><a class="menu--section" href="$Link" data-scroll="$Link">$Title</a></li>
        <% end_loop %>
    </ul>
    <% end_if %>


# Menu Extension

Not really related:

    Page:
      extensions:
      - ATW\ElementalBase\Extensions\MenuPageExtension
      menus:
        main: "Main menu"
        footer: "Footer menu"
    PageController:
      extensions:
      - ATW\ElementalBase\Extensions\MenuContentControllerExtension

In the template:

    <% loop $FilteredMenu("main", 1) %>
    <li><a class="menu--$LinkOrSection" href="$Link">$MenuTitle</a></li>
    <% end_loop %>
