# Release Notes for PAYONE

## 1.0.13 (2020-27-05)

### Changed
- Added Icon for the backend

## 1.1.12 (2020-03-09)

### Changed
- Optimized logging of the data transfer with the Payone Api.

## 1.1.11 (2020-03-03)

### Changed
- New logos and images
- Added methods for the backend visibility and backend name

## 1.1.10 (2019-12-09)

### Fixed
- Writing Order notes during a refund works properly again.

## 1.1.9 (2019-11-07)

### Fixed
- Partial refunds can now be executed more than once. Under certain constellations an error came up. 

## 1.1.8 (2019-10-25)

### Fixed
- Partial refunds will use the correct amount from the credit note or return.

### Changed
- Refund payments will added to the credit note or return from where they were executed.
- The loading times of the plugin have been improved.

## 1.1.7 (2019-09-26)

### Added
- An order note will added for refunds. Please add an user ID in the plugin configurations.

## 1.1.6 (2019-08-23)

### Fixed
- Fix wrong order creation

## 1.1.5 (2019-08-23)

### Fixed
- External orders will be created correct without skipping by the plugin. 

## 1.1.4 (2019-08-15)

### Changed
- The Payone SDK was relocated

### Added
- The payment method Amazon Pay was added for the backend.

### Fixed
- Some log messages

## 1.1.3 (2019-06-13)

### Changed
- Optimisation for Entering the date of birth in the checkout process.
- Updated user guide

## 1.1.2 (2019-05-10)

### Changed
- Entering the date of birth is now mandatory in the checkout process. The field for the date of birth must be activated in the Ceres settings for the checkout process.

### Added
- Net orders can now be executed.

## 1.1.1 (2019-04-02)

### Fixed
- An error causing the creation of duplicate orders during payment processing has been fixed
- An error with the credit card type selection was fixed

## 1.1.0 (2019-03-27)

### Changed
- Support is now within the responsibility of plentysystems
- Added new icons and customised descriptions
- Updated German and English user guides

## 1.0.9 (2018-04-10)

### Changed
- Added alert text to user guide

## 1.0.8 (2018-25-09)

### Changed
- Updated information in the support tab
- Updated changelog

## 1.0.7 (2018-20-09)

### Updated
- Updated the config.json file to implement new plugin format

### Added
- Added translations

### Changed
- Updated user guide
- Implemented guzzle/httpguzzle version in dependency for PayPal compatibility

## 1.0.6 (2018-05-15)

### Added
- Sofort is now displayed in the front end
- Paydirekt is now displayed in the front end
- Secure invoice is now displayed in the front end
- PayPal is now displayed in the front end

### Changed
- Improved rendering of payment error message

## 1.0.5 (2018-04-06)

### Changed
- Updated logos and plugin name

## 1.0.4 (2018-03-27)

### Changed
- Updated documentation

## 1.0.3 (2018-03-26)

### Added
- Added English documentation

### Changed
- The current Payone PHP API is now used

## 1.0.2 (2018-03-21)

### Changed
- Scriptloader is now used to include Payone scripts in templates

## 1.0.1 (2018-03-01)

### Changed
- Update plugin documentation

## 1.0.1 (2018-03-01)
Plugin release supporting the following payment methods:

- Invoice
- Prepayment
- Cash on delivery
- Debit payment
- Credit card
- Credit card 3DS
