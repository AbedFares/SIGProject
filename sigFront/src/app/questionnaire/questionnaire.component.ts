import { Component, OnInit } from '@angular/core';
import {FormControl, FormsModule, NgForm, Validators} from '@angular/forms';
import { Router, ActivatedRoute } from '@angular/router';
import {SigConnexion} from '../classe/SigConnexion';
import {CatalogueService} from '../service/catalogue.service';


@Component({
  selector: 'app-questionnaire',
  templateUrl: './questionnaire.component.html',
  styleUrls: ['./questionnaire.component.css']
})
export class QuestionnaireComponent implements OnInit {
  i = new SigConnexion();
  position!: string;
  constructor(private router:Router, private service: CatalogueService,private route: ActivatedRoute) { }

  ngOnInit(): void {
    
   
  }
  enregistrer(f: NgForm): void {
    this.service.ville = this.i.pos;
     console.log(f);
     console.log('valeurs', JSON.stringify(f.value));
     this.service.saveInfo(this.service.ville,this.i).subscribe(data => {
     console.log('response recieved');
      console.log(this.service.ville);
     });
    }
  
  Retour():void{
    this.router.navigate(['']);
  }
}