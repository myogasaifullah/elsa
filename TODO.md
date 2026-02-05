# TODO: Add Filter Features to laporan/progres.blade.php

## Completed Tasks

- [x] Update LaporanController.php progres method to include fakultas_year and fakultas_month in filter parameters
- [x] Add fakultas_year and fakultas_month filtering logic to getFilteredProgress method
- [x] Add unique years and months calculation in progres method
- [x] Update laporan/progres.blade.php to include year and month dropdown filters in the form
- [x] Fix Carbon month formatting error by casting to int

## Summary

Added filter functionality for faculty, year, and month to the laporan/progres.blade.php page. The existing faculty filter was already present, so new year and month filters were added. The form layout was adjusted to accommodate 5 filter fields in a single row. Fixed a Carbon error in month display formatting.
