import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { BrowserModule } from '@angular/platform-browser';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { AuthGuard } from './auth/auth-guard.service';
import { AuthLogout } from './auth/auth-logout';
import { AuthPreventLoginPage } from './auth/auth-prevent-login-page.services';
import { AuthService } from './auth/auth.service';
import { BusyLoaderModule } from './busy-loader.module';
import { ContentService } from './getData/content.service';
import { HeaderComponent } from './home/header/header.component';
import { HomeComponent } from './home/home.component';
import { ProcessingTableComponent } from './home/tables/processing-table/processing-table.component';
import { TablesComponent } from './home/tables/tables.component';
import { LoginComponent } from './login/login.component';
import { MatMaterialModule } from './mat-material.module';
import { NotFoundComponent } from './not-found/not-found.component';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    HomeComponent,
    NotFoundComponent,
    TablesComponent,
    HeaderComponent,
    ProcessingTableComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpModule,
    AppRoutingModule,
    MatMaterialModule,
    BusyLoaderModule,
    BrowserAnimationsModule
  ],
  providers: [
    AuthService,
    AuthGuard,
    AuthPreventLoginPage,
    AuthLogout,
    ContentService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
