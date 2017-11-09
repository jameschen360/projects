import { NgModule } from '@angular/core';
import { MatButtonModule,
            MatCheckboxModule,
            MatTabsModule,
            MatProgressSpinnerModule
        } from '@angular/material';

@NgModule({
    imports: [
        MatButtonModule,
        MatCheckboxModule,
        MatTabsModule,
        MatProgressSpinnerModule

    ],
    exports: [
        MatButtonModule,
        MatCheckboxModule,
        MatTabsModule,
        MatProgressSpinnerModule
    ],
})
export class MatMaterialModule { }
