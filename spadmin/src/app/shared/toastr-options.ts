import {ToastOptions} from 'ng2-toastr';

export class ToastrOptions extends ToastOptions {
  animate = 'flyRight'; // you can override any options available
  newestOnTop = false;
  showCloseButton = true;
  closeButton = true;
  progressBar = true;
  posiotionClass = 'toast-top-center';
  preventDuplicates =  true;
  showEasing = 'swing';
  hideEasing = 'linear';
  showMethod = 'fadeIn';
  hideMethod = 'fadeOut';
}
