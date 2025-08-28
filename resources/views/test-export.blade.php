<!DOCTYPE html>
<html>
<head>
    <title>Test Export</title>
</head>
<body>
    <h1>Test Export Page</h1>
    <p>This is a test page to verify export functionality.</p>
    <a href="{{ route('laporan.export.progress.pdf') }}">Export Progress PDF</a>
    <a href="{{ route('laporan.export.progress.excel') }}">Export Progress Excel</a>
</body>
</html>
