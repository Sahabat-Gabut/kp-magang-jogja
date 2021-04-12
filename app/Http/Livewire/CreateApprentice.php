<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\{TeamApprentice,Apprentice};

class CreateApprentice extends Component
{
    use WithFileUploads;

    public $agency, $university, $departement, $suratpengantar, $proposal, $ppt, $imagesrc = [], $idjss = [], $npm = [], $cv =[];
    public $inputs = [];
    public $i = 0;

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;

        $this->idjss[$i] = null;
        $this->npm[$i] = null;
        $this->imagesrc[$i] = null;
        $this->cv[$i] = null;

        array_push($this->inputs, $i);
    }
 
    public function remove($i)
    {
        unset($this->idjss[$i+1]);
        unset($this->npm[$i+1]);
        unset($this->imagesrc[$i+1]);
        unset($this->cv[$i+1]);
        unset($this->inputs[$i]);
    }

    public function render()
    {
        $this->idjss['0'] = "JSS-I".\Auth::user()->id;
        return view('livewire.create-apprentice',[
            'dinas' => [
                '1' => 'Dinas Pendidikan Pemudan dan Olahraga',
                '2' => 'Dinas Kesehatan',
                '3' => 'Dinas Pekerjaan Umum, Perumahan, dan Kawasan Permukiman',
                '4' => 'Dinas Pertanahan dan Tata Ruang (Kundha Niti Mandala Sarta Tata Sasana)',
                '5' => 'Satuan Polisi Pamong Praja',
                '6' => 'Dinas Sosial, Tenaga Kerja, dan Transmigrasia',
                '7' => 'Dinas Pemberdayaan Perempuan, Perlindungan Anak, dan Pengendalian Penduduk dan Keluarga Berencana',
                '8' => 'Dinas Kependudukan dan Pencatatan Sipil',
                '9' => 'Dinas Perdagangan',
                '10' => 'Dinas Pertanian dan Pangan',
                '11' => 'Dinas Lingkungan Hidup',
                '12' => 'Dinas Komunikasi Informatika dan Persandian',
                '13' => 'Dinas Perhubungan',
                '14' => 'Dinas Kebudayaan (Kundha Kabudayan)',
                '15' => 'Dinas Pariwisata',
                '16' => 'Dinas Penanaman Modal dan Pelayanan Satu Pintu',
                '17' => 'Dinas Perindustrian, Koperasi, Usaha Kecil dan Menengah',
                '18' => 'Dinas Pemadam Kebakaran dan Penyelamatan',
                '19' => 'Dinas Perpustakaan dan Kearsipan',
            ]
        ]);
    }

    public function store()
    {
        $this->validate([
            'agency'            => 'required',
            'university'        => 'required',
            'departement'       => 'required',
            'suratpengantar'    => 'required|mimes:pdf|max:10000',
            'proposal'          => 'required|mimes:pdf|max:10000',
            'ppt'               => 'required|mimes:ppt,pptx|max:10000',
            'idjss.0'           => 'required',
            'npm.0'             => 'required',
            'cv.0'              => 'required|mimes:pdf|max:10000',
            'imagesrc.0'        => 'required',
            'idjss.*'             => 'required',
            'npm.*'               => 'required',
            'cv.*'                => 'required|mimes:pdf|max:10000',
            'imagesrc.*'          => 'required',
        ],
        [
            'agency.required'           => 'Dinas wajib diisi!',       
            'university.required'       => 'Universitas wajib diisi!',       
            'departement.required'      => 'Jurusan wajib diisi!',       
            'suratpengantar.required'   => 'Surat pengantar wajib diisi!',       
            'suratpengantar.mimes'      => 'Surat pengantar harus berupa pdf',
            'suratpengantar.max'        => 'Ukurat surat pengantar harus dibawah 10Mb',
            'proposal.required'         => 'Proposal wajib diisi!',       
            'proposal.mimes'            => 'Proposal harus berupa pdf',       
            'ppt.required'              => 'Presentasi Projek wajib diisi!',       
            'ppt.mimes'                 => 'Presentasi Projek harus berupa pdf',       
            'imagesrc.0.required'       => 'Pas Foto wajib diisi!',       
            'npm.0.required'            => 'NPM wajib diisi!',       
            'cv.0.required'             => 'CV wajib diisi!',     
            'cv.0.mimes'                => 'CV harus berupa pdf',     
            'idjss.*.required'          => 'ID JSS wajib diisi',
            'npm.*.required'            => 'NPM wajib diisi',
            'cv.*.required'             => 'CV wajib diisi',
            'cv.*.mimes'                => 'CV harus berupa pdf',
            'imagesrc.*.required'       => 'Pas Foto wajib diisi',
        ]);

        return dd($this->agency,$this->university, $this->departement, $this->suratpengantar, $this->proposal, $this->ppt, $this->idjss, $this->npm, $this->cv, $this->imagesrc);
    }

    private function resetInputFields(){
        $this->agency           = ''; 
        $this->university       = ''; 
        $this->departement      = '';
        $this->suratpengantar   = ''; 
        $this->proposal         = ''; 
        $this->ppt              = ''; 
        $this->idjss            = ''; 
        $this->npm              = ''; 
        $this->cv               = ''; 
        $this->imagesrc         = '';
    }
}
