# TODO: Add Import Feature for MOOC Data

## Completed Tasks
- [x] Add importMooc method to DosenMoocController.php
- [x] Add route for mooc.import in routes/web.php
- [x] Add import button and modal to resources/views/akademik/mooc.blade.php
- [x] Add JavaScript for import form submission in resources/views/akademik/dosen-mooc.blade.php
- [x] Fix missing route error by adding the route to routes/web.php
- [x] Fix import button not clickable by placing modal outside the card

## Summary
The import feature for MOOC data has been successfully added to the view `resources/views/akademik/dosen-mooc.blade.php`. Users can now import MOOC data from an Excel file containing columns `judul_mooc` and `dosen_id`. The route was initially missing and has been added. The button was not clickable due to modal placement inside the card, which has been fixed.
