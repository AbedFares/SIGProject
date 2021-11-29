import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FormulairedynamiqueComponent } from './formulairedynamique.component';

describe('FormulairedynamiqueComponent', () => {
  let component: FormulairedynamiqueComponent;
  let fixture: ComponentFixture<FormulairedynamiqueComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ FormulairedynamiqueComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(FormulairedynamiqueComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
