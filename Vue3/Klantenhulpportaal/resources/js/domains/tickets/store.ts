import { TICKET_DOMAIN_NAME } from ".";
import { storeModuleFactory } from "../../services/store";
import { Ticket } from "./types";

export const TicketStore = storeModuleFactory<Ticket>(TICKET_DOMAIN_NAME)
