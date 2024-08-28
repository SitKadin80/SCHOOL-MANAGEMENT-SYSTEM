<?php

namespace App\Observers;

use App\Models\Student;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StudentObserver
{
  
     /**
      * Handle the Student "creating" event.
      */
     public function creating(Student $student): void
     {
         $student->created_by = Auth::id();
     }
 
     /**
      * Handle the Student "updating" event.
      */
     public function updating(Student $student): void
     {
        $student->updated_by =Auth::id();
     }
 
     /**
      * Handle the Student "created" event.
      */
     public function created(Student $student): void
     {
        
     }
     public function deleting(Student $student)
     {
         $student->deleted_by =Auth::id();
         $student->save(); 
     }
 
     /**
      * Handle the Student "updated" event.
      */
     public function updated(Student $student): void
     {
        //  
      
         $student->updated_by=Auth::id();
     }
 
     /**
      * Handle the Student "deleted" event.
      */
     public function deleted(Student $student): void
     {
    //    
     }
 
     /**
      * Handle the Student "restored" event.
      */
     public function restored(Student $student): void
     {
        //  
     }
 
     /**
      * Handle the Student "force deleted" event.
      */
     public function forceDeleted(Student $student): void
     {
    //  
     }
}
