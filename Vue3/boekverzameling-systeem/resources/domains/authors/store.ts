import { storeModuleFactory } from '../../js/services/store';
import { Author } from '../types';


// Initialiseert de store module voor authors 
export const authorStore = storeModuleFactory<Author>('authors');

