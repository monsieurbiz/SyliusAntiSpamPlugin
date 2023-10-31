[![Banner of Sylius Anti Spam plugin](docs/images/banner.jpg)](https://monsieurbiz.com/agence-web-experte-sylius)

<h1 align="center">Anti Spam</h1>

[![Anti Spam Plugin license](https://img.shields.io/github/license/monsieurbiz/SyliusAntiSpamPlugin?public)](https://github.com/monsieurbiz/SyliusAntiSpamPlugin/blob/master/LICENSE.txt)
[![Tests](https://github.com/monsieurbiz/SyliusAntiSpamPlugin/actions/workflows/tests.yaml/badge.svg)](https://github.com/monsieurbiz/SyliusAntiSpamPlugin/actions/workflows/tests.yaml)
[![Security](https://github.com/monsieurbiz/SyliusAntiSpamPlugin/actions/workflows/security.yaml/badge.svg)](https://github.com/monsieurbiz/SyliusAntiSpamPlugin/actions/workflows/security.yaml)
[![Flex Recipe](https://github.com/monsieurbiz/SyliusAntiSpamPlugin/actions/workflows/recipe.yaml/badge.svg)](https://github.com/monsieurbiz/SyliusAntiSpamPlugin/actions/workflows/recipe.yaml)

This plugins adds captcha and allows you to manage your spams.

## Installation

⚙️ To Be Defined.

<!--
1. Use the trait `\MonsieurBiz\SyliusAntiSpamPlugin\Entity\CustomerQuarantineItemAwareTrait` in your Customer entity. 

2. Update your env vars with your Recaptcha site key and secret : 

RECAPTCHA3_KEY=my_site_key
RECAPTCHA3_SECRET=my_secret

-->

## Documentation

⚙️ To Be Completed.

### Remove automatically quarantine entities (experimental)

1. Add the `monsieurbiz_anti_spam.quarantineable` tag on our entity, for example for Customer:

```yaml
    App\Entity\Customer\Customer:
        tags: ['monsieurbiz_anti_spam.quarantineable']
```

2. Confirm or adjust the exceeded periods, by quarantine level, before remove the entities. By default, the:

- suspected item is removed after 1 year
- likely item is removed after 182 days
- proven item is removed after 90 days

You can change there periods in `config/packages/monsieurbiz_sylius_anti_spam_plugin.yaml`:
```yaml
monsieurbiz_sylius_anti_spam:
    exceeded:
        suspected: '1 day'

```

3. Add in your crontab the remove command, example:

```bash
0 */6 * * * /usr/bin/flock -n /tmp/lock.app.remove_exceeded_quarantine bin/console monsieurbiz:anti-spam:remove-exceeded-quarantine-items
```

## Contributing

You can open an Issue or a Pull Request if you want! 😘  
Thank you!

## Sponsors

This plugin is sponsored by:

- [Épices Rœllinger](https://www.epices-roellinger.com/)
- [Monsieur Biz](https://monsieurbiz.com/)

## License

This plugin is completely free and released under the [MIT License](LICENSE.txt).
