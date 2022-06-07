<div>
      <!-- delete_modal_Grade -->
      <div class="modal fade" id="delete{{ $my_parent->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                       id="exampleModalLabel">
                       هل انت متأكد من الحدف 
                   </h5>
                   <button type="button" class="close" data-dismiss="modal"
                           aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                
                   <h4> ستمسح البيانات بصفة نهائية ادا ضغطت علي حفظ البيانات </h4>
                       <div class="modal-footer">
                           <button type="button" class="btn btn-secondary"
                                   data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                           <button type="submit" wire:click="delete({{ $my_parent->id }})"
                                   class="btn btn-danger">{{ trans('Grades_trans.submit') }}</button>
                       </div>
                  
               </div>
           </div>
       </div>
   </div>


</div>