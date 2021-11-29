import { Injectable } from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {Observable} from 'rxjs';
import {SigConnexion} from '../classe/SigConnexion';

@Injectable({
  providedIn: 'root'
})
export class CatalogueService {
  ville !: string;
  constructor(private httpClient: HttpClient) { }
  public saveInfo(ville: String , user: SigConnexion): Observable<any> {
    return this.httpClient.post<any>('http://localhost:8090/connexion/enregistrer/'+ville,user);
  }
  
}