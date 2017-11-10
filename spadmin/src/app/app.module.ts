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
import { LoginService } from './server/login.service';
import { BusyLoaderModule } from './busy-loader.module';
import { MaterialModule } from './material.module';
import { ProcessingTableService } from './server/processing-table.service';
import { HeaderComponent } from './home/header/header.component';
import { HomeComponent } from './home/home.component';
import { ProcessingTableComponent } from './home/tables/processing-table/processing-table.component';
import { TablesComponent } from './home/tables/tables.component';
import { LoginComponent } from './login/login.component';
import { NotFoundComponent } from './not-found/not-found.component';
import { ProcessingModalComponent } from './home/tables/processing-table/processing-modal/processing-modal.component';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    HomeComponent,
    NotFoundComponent,
    TablesComponent,
    HeaderComponent,
    ProcessingTableComponent,
    ProcessingModalComponent
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
    ProcessingModalComponent
  ],
  providers: [
    LoginService,
    AuthGuard,
    AuthPreventLoginPage,
    AuthLogout,
    ProcessingTableService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
