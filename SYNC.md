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
  `translations/*/{admin/general,charge_wallet,user/general}.php` (license strings),
  `translations/*/{shopsms_license.php}`, `tests/Unit/License/`, `HOWTO.md`
- Demo-mode relocation (this fork removes controller-level demo guards, guards
  centrally instead): `includes/functions.php` (`is_demo_user/is_demo_group`
  deleted), `includes/Repositories/UserRepository.php`,
  `includes/Http/Controllers/Api/Admin/{GroupResource,UserPasswordResource,UserResource}.php`,
  `includes/Http/Controllers/Api/Shop/{PasswordResetController,PasswordResource,UserProfileResource}.php`,
  `includes/System/Application.php` (provider registration),
  `includes/View/Pages/Admin/PageAdminMain.php` (income brick),
  `confidential/.env.example` (`LICENSE_SECRET`), and the matching test
  expectations in `tests/Feature/...` (same basenames)
- CI: Coveralls upload stays `if: false` (this fork does not report coverage)
