import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { QuestionnaireComponent } from './questionnaire/questionnaire.component';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import {FormsModule } from '@angular/forms';
import {ReactiveFormsModule} from '@angular/forms';
import { EspaceComponent } from './espace/espace.component';
import { RouterModule, Routes } from '@angular/router';
import { HttpClientModule } from '@angular/common/http';
import { FormulairedynamiqueComponent } from './formulairedynamique/formulairedynamique.component';

const appRoutes: Routes = [
  {
    path: '',
    component: EspaceComponent
  },
  {
    path: 'form',
    component: FormulairedynamiqueComponent
  },
  {
    path: 'quest',
    component: QuestionnaireComponent
  }
]

@NgModule({
  declarations: [
    AppComponent,
    QuestionnaireComponent,
    EspaceComponent,
    FormulairedynamiqueComponent
  ],
  imports: [
    RouterModule.forRoot(appRoutes),
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpClientModule,
    NgbModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
