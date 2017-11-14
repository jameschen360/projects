import { NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { BrowserModule } from '@angular/platform-browser';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { AuthGuard } from './auth/auth-guard.service';
import { AuthLogout } from './auth/auth-logout';
import { AuthPreventLoginPage } from './auth/auth-prevent-login-page.services';
import { BusyLoaderModule } from './busy-loader.module';
import { HeaderComponent } from './home/header/header.component';
import { HomeComponent } from './home/home.component';
import { DeliveredModalComponent } from './home/tables/delivered-table/delivered-modal/delivered-modal.component';
import { DeliveredTableComponent } from './home/tables/delivered-table/delivered-table.component';
import { MaitTableComponent } from './home/tables/mait-table/mait-table.component';
import { ProcessingModalComponent } from './home/tables/processing-table/processing-modal/processing-modal.component';
import { ProcessingTableComponent } from './home/tables/processing-table/processing-table.component';
import { ProductTableComponent } from './home/tables/product-table/product-table.component';
import { TablesComponent } from './home/tables/tables.component';
import { UserTableComponent } from './home/tables/user-table/user-table.component';
import { LoginComponent } from './login/login.component';
import { MaterialModule } from './material.module';
import { NotFoundComponent } from './not-found/not-found.component';
import { DeliveredTableService } from './server/delivered-table/delivered-table.service';
import { LoginService } from './server/login.service';
import { ProcessingModalService } from './server/processing-table/processing-modal.service';
import { ProcessingTableService } from './server/processing-table/processing-table.service';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    HomeComponent,
    NotFoundComponent,
    TablesComponent,
    HeaderComponent,
    ProcessingTableComponent,
    ProcessingModalComponent,
    DeliveredTableComponent,
    UserTableComponent,
    MaitTableComponent,
    ProductTableComponent,
    DeliveredModalComponent,
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpModule,
    AppRoutingModule,
    BusyLoaderModule,
    BrowserAnimationsModule,
    ReactiveFormsModule,
    MaterialModule
  ],
  entryComponents: [
    ProcessingModalComponent,
    DeliveredModalComponent
  ],
  providers: [
    LoginService,
    AuthGuard,
    AuthPreventLoginPage,
    AuthLogout,
    ProcessingTableService,
    ProcessingModalService,
    DeliveredTableService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
