import { NgModule } from '@angular/core';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { MatButtonModule,
            MatCheckboxModule,
            MatTabsModule,
            MatProgressSpinnerModule
        } from '@angular/material';

@NgModule({
    imports: [
        BrowserAnimationsModule,
        MatButtonModule,
        MatCheckboxModule,
        MatTabsModule,
        MatProgressSpinnerModule

    ],
    exports: [
        BrowserAnimationsModule,
        MatButtonModule,
        MatCheckboxModule,
        MatTabsModule,
        MatProgressSpinnerModule
    ],
})
export class MatMaterialModule { }
