import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-espace',
  templateUrl: './espace.component.html',
  styleUrls: ['./espace.component.css']
})
export class EspaceComponent implements OnInit {


  constructor(private router: Router) { }

  ngOnInit(): void {
  }

  quest(): void {
    console.log("aaaa");
    this.router.navigate(['/quest']);
  }


}
