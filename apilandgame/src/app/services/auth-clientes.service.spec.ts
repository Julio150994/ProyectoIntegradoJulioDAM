import { TestBed } from '@angular/core/testing';

import { AuthClientesService } from './auth-clientes.service';

describe('AuthClientesService', () => {
  let service: AuthClientesService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(AuthClientesService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
