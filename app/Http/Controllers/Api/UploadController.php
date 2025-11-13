<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class UploadController extends Controller
{
public function upload(Request $request)
{
if ($request->hasFile('file')) {
$file = $request->file('file');
$filename = time() . '_' . $file->getClientOriginalName();
$path = $file->storeAs('images', $filename, 'public');
return response()->json([
'status' => 'success',
'filename' => $filename,
'url' => asset('storage/images/' . $filename)
]);
}
return response()->json(['status' => 'error', 'message' => 'Aucun
fichier reçu'], 400);
}
}