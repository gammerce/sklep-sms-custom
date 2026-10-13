# Fork sync: sklep-sms → sklep-sms-custom

This repo is a fork of `gammerce/sklep-sms` plus the store License layer.
All shared work lands upstream first (PRs there); this repo receives it by
merging `upstream/master` (configure the `upstream` remote once pointing at
`gammerce/sklep-sms`). Open PRs here **only** for custom-only changes.

## Custom-owned paths (expect merge conflicts here, keep ours)

- `includes/License/` — the License module
- `includes/Providers/LicenseServiceProvider.php` — its wiring
- `migrations/2018_01_14_230341_init_shop.{php,sql}` — license table + seeds
- License storefront/theme/i18n: `src/js/shop/pages/{purchase/shopsms_license{,_prolong},user_own_services/shopsms_license}.ts`,
  `src/images/{abstract-fluid,tick,reload}.{jpg,png}`, `src/stylesheets/shop/services/`,
  `themes/shopsms/`, `themes/fusion/shop/pages/{privacy_policy,profile,register}.html`,
  `translations/*/{shopsms_license.php}` (the only translation-layer custom
  content; the shared language files stay identical to upstream),
  `tests/Unit/License/`, `HOWTO.md`
- Store wiring: `includes/System/Application.php` (License provider
  registration), `includes/View/Pages/Admin/PageAdminMain.php` (license
  income brick), `confidential/.env.example` (`LICENSE_SECRET`), and the
  `ThemeRepositoryTest` expectation (the `shopsms` theme exists here)
- CI: Coveralls upload stays `if: false` (this fork does not report coverage)
