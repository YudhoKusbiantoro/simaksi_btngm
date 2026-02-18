<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SimaksiApproval;
use App\Http\Controllers\Admin\SimaksiApprovalController;

$approvals = SimaksiApproval::all();
$controller = new SimaksiApprovalController();

echo "Updating " . $approvals->count() . " records and re-generating PDFs...\n";

foreach ($approvals as $approval) {
    $pengajuan = $approval->pengajuan;
    if (!$pengajuan)
        continue;

    $oldNo = $approval->nomor_surat;
    $newNo = str_replace('SL. ', 'SI. ', $oldNo);

    $parts = explode('/', $newNo);
    if (count($parts) >= 6) {
        $parts[3] = strtoupper($parts[3]);
        $newNo = implode('/', $parts);
    }

    // Update DB
    $approval->update([
        'nomor_surat' => $newNo,
        'kode_surat' => strtoupper($approval->kode_surat)
    ]);

    // Use reflection to call private generatePDF method
    $reflection = new ReflectionClass(SimaksiApprovalController::class);
    $method = $reflection->getMethod('generatePDF');
    $method->setAccessible(true);

    $pdfPath = $method->invoke($controller, $pengajuan, $approval);
    $approval->update(['file_pdf' => $pdfPath]);

    echo "Fixed: $oldNo -> $newNo | PDF Re-generated\n";
}

echo "Done!\n";
