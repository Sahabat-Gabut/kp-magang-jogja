<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\{TeamApprentice,Apprentice,Agency,Project};

class CreateApprentice extends Component
{
    use WithFileUploads;

    public $agency, $university, $departement, $cover_letter, $proposal, $presentation, $project_name, $project_explanation;
    public $imagesrc = [], $idjss = [], $npm = [], $cv =[];
    public $inputs = [];
    public $i = 0;
    public $dataAgency;

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;

        $this->idjss[$i] = null;
        $this->npm[$i] = null;

        array_push($this->inputs, $i);
    }
 
    public function remove($i)
    {
        unset($this->idjss[$i+1]);
        unset($this->npm[$i+1]);
        unset($this->imagesrc[$i+1]);
        unset($this->cv[$i+1]);
        unset($this->inputs[$i]);
        $this->i--;
    }

    public function render()
    {
        $this->idjss['0'] = "JSS-I".\Auth::user()->id;

        $this->dataAgency = Agency::all();

        return view('livewire.create-apprentice');
    }

    public function store()
    {
        $validationData = $this->validate([
            'agency'                => 'required',
            'university'            => 'required',
            'departement'           => 'required',
            'cover_letter'          => 'required|mimes:pdf|max:10000',
            'proposal'              => 'required|mimes:pdf|max:10000',
            'presentation'          => 'required|mimes:ppt,pptx|max:10000',
            'idjss.0'               => 'required',
            'npm.0'                 => 'required',
            'cv.0'                  => 'required|mimes:pdf|max:10000',
            'imagesrc.0'            => 'required',
            'idjss.*'               => 'required',
            'npm.*'                 => 'required',
            'cv.*'                  => 'required|mimes:pdf|max:10000',
            'imagesrc.*'            => 'required',
            'project_name'          => 'required',
            'project_explanation'   => 'required',
        ],
        [
            'agency.required'           => 'Dinas wajib diisi!',       
            'university.required'       => 'Universitas wajib diisi!',       
            'departement.required'      => 'Jurusan wajib diisi!',       
            'cover_letter.required'     => 'Surat pengantar wajib diisi!',       
            'cover_letter.mimes'        => 'Surat pengantar harus berupa pdf',
            'cover_letter.max'          => 'Ukurat surat pengantar harus dibawah 10Mb',
            'proposal.required'         => 'Proposal wajib diisi!',       
            'proposal.mimes'            => 'Proposal harus berupa pdf',       
            'presentation.required'     => 'Presentasi Projek wajib diisi!',       
            'presentation.mimes'        => 'Presentasi Projek harus berupa pdf',      
            'project_name.required'     => 'Nama projek wajib diisi!',
            'project_explanation.required'=> 'Deskripsi projek wajib diisi!', 
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

        $validationData["cover_letter"]     = $this->cover_letter->store('files','public');
        $validationData["proposal"]         = $this->proposal->store('files','public');
        $validationData["presentation"]     = $this->presentation->store('files','public');
        
        TeamApprentice::create([
            'agency_id'     => $this->agency,
            'university'    => $this->university,
            'departement'   => $this->departement,
            'proposal'      => "/storage/".$validationData["proposal"],
            'presentation'  => "/storage/".$validationData["presentation"],
            'cover_letter'  => "/storage/".$validationData["cover_letter"],
            'date_of_created' => NOW()
        ]);

        Project::create([
            'team_apprentice_id' => TeamApprentice::where('cover_letter',"/storage/".$validationData["cover_letter"])->first()->id,
            'name_project'       => $this->project_name,
            'explanation'        => $this->project_explanation
        ]);
            
        foreach ($this->idjss as $key => $value) {
            $this->idjss[$key]        =  \str_replace("JSS-I","",$this->idjss[$key]);
            $validationData["cv"]     = $this->cv[$key]->store('files','public');
            $validationData["imgSrc"] = $this->imagesrc[$key]->store('files','public');

            Apprentice::create([
                'jss_id'                => $this->idjss[$key], 
                'npm'                   => $this->npm[$key],
                'team_apprentice_id'    => TeamApprentice::where('cover_letter',"/storage/".$validationData["cover_letter"])->first()->id, 
                'cv'                    => "/storage/".$validationData["cv"],
                'imgSrc'                => "/storage/".$validationData["imgSrc"]
            ]);
        }

        return route('dashboard');
    }

    private function resetInputFields(){
        $this->agency           = ''; 
        $this->university       = ''; 
        $this->departement      = '';
        $this->cover_letter     = ''; 
        $this->proposal         = ''; 
        $this->presentation     = ''; 
        $this->idjss            = ''; 
        $this->npm              = ''; 
        $this->cv               = ''; 
        $this->imagesrc         = '';
    }
}
