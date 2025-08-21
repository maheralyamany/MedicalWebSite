<?php
namespace App\Traits;
use App\Utilities\Date;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
trait UploadFiles
{
    /* public function uploadFile($file, $folder, $lastPath = null)
    {
       try {
        $filename = time().'_'.$file->getClientOriginalName();
            $path = 'images/' . $folder;
        $file->move($path, $filename);
        return $path . '/' . $filename; 
            //$file->store('/', $folder);
            //$filename = $file->hashName();
            // $filename = $this->getMediaFileName($file);
        $file->move('images/' . $folder, $filename);
       // $filename = time() . '_' . $file->getClientOriginalName();
        $path = 'images/' . $folder . '/' . $filename;
        return $path;
       } catch (\Throwable $th) {
           //throw $th;
       }
       return '';
    } */
    public function uploadFile($file, $folder, $lastPath = null)
    {
        try {
            if (!empty($lastPath) && $lastPath != null) {
                if (file_exists($lastPath))
                    unlink($lastPath);
            }
        } catch (\Throwable $th) {
            // throw $th;
        }
        $per = $this->getFilePer($file);
        try {
            $path = 'images/' . $folder . '/';
            $fileInfo = $file->getClientOriginalName();
            $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
            $filename = $per . "_" . Carbon::now()->format('YmdHis') . '.' . $extension;
            $file->move($path, $filename);
            $filePath = 'images/' . $folder . '/' . $filename;
            return $filePath;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function getMediaPathOnStorage($media)
    {
        if (!is_object($media)) {
            return false;
        }
        $path = $media->getDiskPath();
        if (Storage::missing($path)) {
            return false;
        }
        return $path;
    }
    public function streamMedia($media)
    {
        return response()->streamDownload(
            function () use ($media) {
                $stream = $media->stream();
                while ($bytes = $stream->read(1024)) {
                    echo $bytes;
                }
            },
            $media->basename,
            [
                'Content-Type'      => $media->mime_type,
                'Content-Length'    => $media->size,
            ],
        );
    }
    public function isLocalStorage()
    {
        return config('filesystems.disks.' . config('filesystems.default') . '.driver') == 'local';
    }
    public function getMediaFileName($file): string
    {
        $file_name = $this->filename($file);
        if (Str::length($file_name) > '110') {
            $file_name = Str::limit($file_name, 110);
        }
        return $file_name . '.' . $this->extension($file);
    }
    /**
     * {@inheritdoc}
     */
    public function filename($file): string
    {
        /* $fileName = auth()->id() . '_' . time() . '.'. $request->file->extension();
          $type = $file->getClientMimeType();
        $size = $request->file->getSize();
        $request->file->move(public_path('file'), $fileName); */
        return pathinfo((string)$file->getClientOriginalName(), PATHINFO_FILENAME);
    }
    private function getFilePer($file): string
    {
        try {
            $type = $file->getClientMimeType();
            $per = (isset($type) && !empty($type)) ? (explode('/', $type))[0] : "img";
            return $per;
        } catch (\Throwable $th) {
            return "img";
        }
    }
    /**
     * {@inheritdoc}
     */
    public function extension($file): string
    {
        $extension = $file->getClientOriginalExtension();
        if ($extension) {
            return $extension;
        }
        return (string)$file->guessExtension();
    }
}
