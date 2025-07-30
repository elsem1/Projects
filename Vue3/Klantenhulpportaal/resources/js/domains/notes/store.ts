import { NOTE_DOMAIN_NAME } from ".";
import { storeModuleFactory } from "../../services/store";
import { Note } from "./types";

export const TicketStore = storeModuleFactory<Note>(NOTE_DOMAIN_NAME)