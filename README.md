<p align="center">
    <a href="https://monsieurbiz.com" target="_blank">
        <img src="https://monsieurbiz.com/logo.png" width="250px" alt="Monsieur Biz logo" />
    </a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="https://monsieurbiz.com/agence-web-experte-sylius" target="_blank">
        <img src="https://demo.sylius.com/assets/shop/img/logo.png" width="200px" alt="Sylius logo" />
    </a>
    <br/>
    <img src="https://monsieurbiz.com/assets/images/sylius_badge_extension-artisan.png" width="100" alt="Monsieur Biz is a Sylius Extension Artisan partner">
</p>

<h1 align="center">Anti Spam</h1>

[![Anti Spam Plugin license](https://img.shields.io/github/license/monsieurbiz/SyliusAntiSpamPlugin?public)](https://github.com/monsieurbiz/SyliusAntiSpamPlugin/blob/master/LICENSE.txt)
[![Tests Status](https://img.shields.io/github/workflow/status/monsieurbiz/SyliusAntiSpamPlugin/Tests?logo=github)](https://github.com/monsieurbiz/SyliusAntiSpamPlugin/actions?query=workflow%3ATests)
[![Security Status](https://img.shields.io/github/workflow/status/monsieurbiz/SyliusAntiSpamPlugin/Security?label=security&logo=github)](https://github.com/monsieurbiz/SyliusAntiSpamPlugin/actions?query=workflow%3ASecurity)

This plugins adds captcha and allows you to manage your spams.

## Installation

⚙️ To Be Defined.

<!--
1. Use the trait `\MonsieurBiz\SyliusAntiSpamPlugin\Entity\CustomerQuarantineItemAwareTrait` in your Customer entity. 
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
