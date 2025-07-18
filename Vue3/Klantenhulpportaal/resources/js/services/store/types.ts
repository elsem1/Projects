import type {Ref} from 'vue';
import { Ticket } from '../../domains/tickets/types';

export type State<T extends {id: number}> = Ref<{[id: number]: Readonly<T>}>;

export type New<T extends {id: number}> = Omit<T, 'id'>;

export type Updatable<T extends {id: number}> = New<T> & {
    id?: number;
};
