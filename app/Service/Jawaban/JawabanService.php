<?php
namespace App\Service\Jawaban;

use App\Models\Jawaban;
use App\Service\Contract\JawabanSeriviceInterface;
use Illuminate\Support\Facades\Auth;

class JawabanService implements JawabanSeriviceInterface {

    public function __construct(
        protected Jawaban $jawabanModel
    ) {}


    public function GetAllJawaban() {
        $jawaban = Jawaban::whereHas('user', function($user) {
            $user->where('id',Auth::user()->id);
        })->get();
        return $jawaban;
    }

    public function CreateJawaban($data) {
        $jawaban = new Jawaban();
        $jawaban->fill([
            ...$data,
            'user_id' => Auth::user()->id
        ]);
        $jawaban->save();
        return $jawaban;
    }


    public function UpdateJawaban($id, $data) {
        $jawaban = $this->jawabanModel->findOrFail($id);
        $jawaban->update($data);

        return $jawaban;

    }

    public function DeleteJawaban($id) :bool {
        $jawaban = $this->jawabanModel->findOrFail($id);
        if(!$jawaban) {
            return false;
        }
        $delete = $jawaban->delete();
        return $delete;
    }
}



?>