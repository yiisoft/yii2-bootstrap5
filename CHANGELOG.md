Yii Framework 2 bootstrap5 extension Change Log
==============================================

2.0.5 under development
-----------------------

- Bug #72: Nav::isItemActive(): Return value must be of type bool, int returned (hirenbhut93)
- Bug #62: Navbar can now accept `collapseOptions` to be `false` (theblindfrog)

2.0.4 November 30, 2022
-----------------------

- Bug #58: Dropdown clientEvents did not fire because they need to be bound on parent (simialbi)
- Bug #43: Accordion widget does not set "collapsed" class on toggle button (simialbi)
- Enh #39: Add inline mode to `BaseHtml::checkboxList()` and `BaseHtml::radioList()` (WinterSilence)
- Enh #40: Breadcrumbs refactoring (WinterSilence)
- Bug #46: Fix data-attribute usage for Dropdown toggle (machour)
- Enh #48: Update `BootstrapWidgetTrait` to initialize JS plugins without jQuery (WinterSilence)


2.0.3 April 22, 2022
--------------------

- Enh #36: `BootstrapWidgetTrait::$clientOptions = false` disables registerJs in `BootstrapWidgetTrait` (julianrutten)
- Enh #33: Updated russian translations (WinterSilence)
- Enh #28: Added translations (simialbi)
- Enh #24: Accept `Breadcrumbs::$homeLink = false` to omit "Home" link (fetus-hina)
- Enh #27: Changed all data- and aria- attributes to short syntax (simialbi)
- Enh #26: Add Bootstrap icon asset (Krakozaber)
- Enh #18: Add rangeInput(), colorInput() and switch mode to checkbox() in class ActiveField (WinterSilence)
- Bug #19: Fix value of attribute "aria-current" in LinkPager::renderPageButton() (WinterSilence)
- Bug #23: Fix class attribute in listBox() and dropDownList() of class ActiveField (WinterSilence)
- Bug #133: Fix default `homeUrl` in `Breadcrumbs` widget (luke-)


2.0.2 October 21, 2021
----------------------

- Bug #5: BootstrapWidgetTrait::registerPlugin do nothing if no clientOptions is provided (dicrtarasov)
- Bug #6: yii\bootstrap5\BaseHtml::staticControl(): Argument #1 ($value) must be of type string, int given (dicrtarasov)
- Bug #9: fixed default ActiveField::hintOptions (dicrtarasov)
- Bug #15: Fixed inline rendering of checkboxLists and radioLists (simialbi)
- Enh #11: Brought back close button api (simialbi)


2.0.1 August 11, 2021
---------------------

- no changes in this release.


1.0.0
-----------------------
- Initial release
