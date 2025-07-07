import { TICKET_DOMAIN_NAME } from ".";
import { storeModuleFactory } from "../../services/store";
import { Ticket } from "./types";

export const ticketStore = storeModuleFactory<Ticket>(TICKET_DOMAIN_NAME)