<?php

namespace App\Http\Livewire\Parents;
use App\Models\Nationalitie;
use App\Models\Religion;
use App\Models\TypeBlood;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use App\Models\MyParent;
use Livewire\WithFileUploads;
use App\Models\ParentAttachment;


class AddParent extends Component
{
    use WithFileUploads;

    public $successMessage = '';

    public $catchError,$updateMode = false,$photos,$show_table = true;

    public $currentStep = 1,

        // Father_INPUTS
        $Parent_id,
        $Email, $Password,
        $Name_Father, $Name_Father_en,
        $National_ID_Father, $Passport_ID_Father,
        $Phone_Father, $Job_Father, $Job_Father_en,
        $Nationality_Father_id, $Blood_Type_Father_id,
        $Address_Father, $Religion_Father_id,

        // Mother_INPUTS
        $Name_Mother, $Name_Mother_en,
        $National_ID_Mother, $Passport_ID_Mother,
        $Phone_Mother, $Job_Mother, $Job_Mother_en,
        $Nationality_Mother_id, $Blood_Type_Mother_id,
        $Address_Mother, $Religion_Mother_id;

        
       
    public function showformadd(){
        $this->show_table = false;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'Email' => 'required|email',
            'National_ID_Father' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Father' => 'min:10|max:10',
            //'Phone_Father' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'National_ID_Mother' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Mother' => 'min:10|max:10',
            //'Phone_Mother' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);
    }



    public function render()
    {
       
        return view('livewire.parents.add-parent', [
            'Nationalities' => Nationalitie::all(),
            'Type_Bloods' => TypeBlood::all(),
            'Religions' => Religion::all(),
            'my_parents' => MyParent::all(),
        ]);

    }

    //firstStepSubmit
    public function firstStepSubmit()
    {
      $this->validate([
            'Email' => 'required|unique:my_parents,Email,'.$this->id,
            'Password' => 'required',
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required|unique:my_parents,National_ID_Father,' . $this->id,
            'Passport_ID_Father' => 'required|unique:my_parents,Passport_ID_Father,' . $this->id,
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id' => 'required',
            'Blood_Type_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',
        ]); 

        $this->currentStep = 2;
    }

    public function updateFirstStepSubmit()
    {
      /* $this->validate([
            'Email' => 'required|unique:my_parents,Email,'.$this->id,
            'Password' => 'required',
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required|unique:my_parents,National_ID_Father,' . $this->id,
            'Passport_ID_Father' => 'required|unique:my_parents,Passport_ID_Father,' . $this->id,
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id' => 'required',
            'Blood_Type_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',
        ]);  */

        //Upadete FAther table
        

        $this->currentStep = 2;
    }

    //secondStepSubmit
    public function secondStepSubmit()
    {

         $this->validate([
            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'National_ID_Mother' => 'required|unique:my_parents,National_ID_Mother,' . $this->id,
            'Passport_ID_Mother' => 'required|unique:my_parents,Passport_ID_Mother,' . $this->id,
            'Phone_Mother' => 'required',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ]);
 
        $this->currentStep = 3;
    }

        //updatesecondStepSubmit
        public function updateSecondStepSubmit()
        {
    
           /*   $this->validate([
                'Name_Mother' => 'required',
                'Name_Mother_en' => 'required',
                'National_ID_Mother' => 'required|unique:my_parents,National_ID_Mother,' . $this->id,
                'Passport_ID_Mother' => 'required|unique:my_parents,Passport_ID_Mother,' . $this->id,
                'Phone_Mother' => 'required',
                'Job_Mother' => 'required',
                'Job_Mother_en' => 'required',
                'Nationality_Mother_id' => 'required',
                'Blood_Type_Mother_id' => 'required',
                'Religion_Mother_id' => 'required',
                'Address_Mother' => 'required',
            ]);
      */
            $this->currentStep = 3;
        }
    

    
    //back
    public function back($step)
    {
        $this->currentStep = $step;
    }

  
    public function submitForm(){
  

        try {
            $My_Parent = new MyParent();
            // Father_INPUTS
            $My_Parent->Email = $this->Email;
            $My_Parent->Password = Hash::make($this->Password);
            $My_Parent->Name_Father = ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father];
            $My_Parent->National_ID_Father = $this->National_ID_Father;
            $My_Parent->Passport_ID_Father = $this->Passport_ID_Father;
            $My_Parent->Phone_Father = $this->Phone_Father;
            $My_Parent->Job_Father = ['en' => $this->Job_Father_en, 'ar' => $this->Job_Father];
            $My_Parent->Passport_ID_Father = $this->Passport_ID_Father;
            $My_Parent->Nationality_Father_id = $this->Nationality_Father_id;
            $My_Parent->Blood_Type_Father_id = $this->Blood_Type_Father_id;
            $My_Parent->Religion_Father_id = $this->Religion_Father_id;
            $My_Parent->Address_Father = $this->Address_Father;

            // Mother_INPUTS
            $My_Parent->Name_Mother = ['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother];
            $My_Parent->National_ID_Mother = $this->National_ID_Mother;
            $My_Parent->Passport_ID_Mother = $this->Passport_ID_Mother;
            $My_Parent->Phone_Mother = $this->Phone_Mother;
            $My_Parent->Job_Mother = ['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother];
            $My_Parent->Passport_ID_Mother = $this->Passport_ID_Mother;
            $My_Parent->Nationality_Mother_id = $this->Nationality_Mother_id;
            $My_Parent->Blood_Type_Mother_id = $this->Blood_Type_Mother_id;
            $My_Parent->Religion_Mother_id = $this->Religion_Mother_id;
            $My_Parent->Address_Mother = $this->Address_Mother;

            $My_Parent->save();
           
            if (!empty($this->photos)){
                foreach ($this->photos as $photo) {
                    $photo->storeAs($this->National_ID_Father, $photo->getClientOriginalName(), $disk = 'parent_attachments');
                    ParentAttachment::create([
                        'file_name' => $photo->getClientOriginalName(),
                        'parent_id' => MyParent::latest()->first()->id,
                    ]);
                }
            }


            $this->successMessage = trans('messages.success');
            $this->clearForm();
            $this->currentStep = 1;
            $this->show_table=true;

        }

        catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        };



    }


    //clearForm
    public function clearForm()
    {
        $this->Email = '';
        $this->Password = '';
        $this->Name_Father = '';
        $this->Job_Father = '';
        $this->Job_Father_en = '';
        $this->Name_Father_en = '';
        $this->National_ID_Father ='';
        $this->Passport_ID_Father = '';
        $this->Phone_Father = '';
        $this->Nationality_Father_id = '';
        $this->Blood_Type_Father_id = '';
        $this->Address_Father ='';
        $this->Religion_Father_id ='';

        $this->Name_Mother = '';
        $this->Job_Mother = '';
        $this->Job_Mother_en = '';
        $this->Name_Mother_en = '';
        $this->National_ID_Mother ='';
        $this->Passport_ID_Mother = '';
        $this->Phone_Mother = '';
        $this->Nationality_Mother_id = '';
        $this->Blood_Type_Mother_id = '';
        $this->Address_Mother ='';
        $this->Religion_Mother_id ='';

    }


    public function delete($id){
         
         MyParent::findOrFail($id)->delete();
        return redirect()->to('/add_parent');    
    }

    public function edit($id){
        
        $this->updateMode= true;
        $this->show_table=false;
        $parent=MyParent::findOrFail($id)->first();
        $this->Parent_id = $id;

        $this->Email = $parent->Email;
        $this->Password =  $parent->Password;
        $this->Name_Father =  $parent->getTranslation('Name_Father', 'ar');
        $this->Job_Father =  $parent->getTranslation('Job_Father', 'ar');;
        $this->Job_Father_en = $parent->getTranslation('Job_Father', 'en');;
        $this->Name_Father_en = $parent->getTranslation('Name_Father', 'en');
        $this->National_ID_Father =$parent->National_ID_Father;
        $this->Passport_ID_Father = $parent->Passport_ID_Father;
        $this->Phone_Father = $parent->Phone_Father;
        $this->Nationality_Father_id = $parent->Nationality_Father_id;
        $this->Blood_Type_Father_id = $parent->Blood_Type_Father_id;
        $this->Address_Father =$parent->Address_Father;
        $this->Religion_Father_id =$parent->Religion_Father_id;

        $this->Name_Mother = $parent->getTranslation('Name_Mother', 'ar');
        $this->Job_Mother = $parent->getTranslation('Job_Mother', 'ar');
        $this->Job_Mother_en = $parent->getTranslation('Job_Mother', 'en');
        $this->Name_Mother_en = $parent->getTranslation('Name_Mother', 'en');
        $this->National_ID_Mother =$parent->National_ID_Mother;
        $this->Passport_ID_Mother = $parent->Passport_ID_Mother;
        $this->Phone_Mother = $parent->Phone_Mother;
        $this->Nationality_Mother_id = $parent->Nationality_Mother_id;
        $this->Blood_Type_Mother_id = $parent->Blood_Type_Mother_id;
        $this->Address_Mother =$parent->Address_Mother;
        $this->Religion_Mother_id =$parent->Religion_Mother_id;


    }
    public function submitForm_edit(){
        
        if ($this->Parent_id){
            $parent = MyParent::find($this->Parent_id);
            $parent->update([
                                    'Email'                  =>$this->Email,
                                    'Password'               =>$this->Password,
                                    'Name_Father'            =>$this->Name_Father= ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father],
                                             
                                    'Job_Father'             =>$this->Job_Father =['en' => $this->Job_Father_en, 'ar' => $this->Job_Father],
                                   
                                    'National_ID_Father'     =>$this->National_ID_Father,
                                    'Passport_ID_Father'     =>$this->Passport_ID_Father,
                                    'Phone_Father'           =>$this->Phone_Father,
                                    'Nationality_Father_id'  =>$this->Nationality_Father_id,
                                    'Blood_Type_Father_id'   =>$this->Blood_Type_Father_id,
                                    'Religion_Father_id'     =>$this->Religion_Father_id,
                                    'Address_Father'         =>$this->Address_Father,
                                    //
                                    'Name_Mother'            =>$this->Name_Mother =['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother],
                                    
                                    'National_ID_Mother'     =>$this->National_ID_Mother,
                                    'Passport_ID_Mother'     =>$this->Passport_ID_Mother,
                                    'Phone_Mother'           =>$this->Phone_Mother,
                                    'Job_Mother'             =>$this->Job_Mother,
                                   
                                    'Nationality_Mother_id'  =>$this->Nationality_Mother_id,
                                    'Blood_Type_Mother_id'   =>$this->Blood_Type_Mother_id,
                                    'Religion_Mother_id'     =>$this->Religion_Mother_id,
                                    'Address_Mother'         =>$this->Address_Mother,   
            ]);

        }

        return redirect()->to('/add_parent');
    }
}
