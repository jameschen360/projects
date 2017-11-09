import { NgModule } from '@angular/core';
import { BusyModule, BusyConfig } from 'angular2-busy';

@NgModule({
    imports: [
        BusyModule

    ],
    exports: [
        BusyModule
    ],
})
export class BusyLoaderModule { }
