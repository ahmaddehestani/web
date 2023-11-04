<?php

namespace App\Enums;

enum PermissionEnum: string
{
    use EnumToArray;

    case ADMIN = "admin";

    case USER_ALL     = "user.all";
    case USER_INDEX   = "user.index";
    case USER_SHOW    = "user.show";
    case USER_STORE   = "user.store";
    case USER_UPDATE  = "user.update";
    case USER_TOGGLE  = "user.toggle";
    case USER_DELETE  = "user.delete";
    case USER_RESTORE = "user.restore";
    //Ticket
    case TICKET_ALL     = "ticket.all";
    case TICKET_INDEX   = "ticket.index";
    case TICKET_SHOW    = "ticket.show";
    case TICKET_STORE   = "ticket.store";
    case TICKET_UPDATE  = "ticket.update";
    case TICKET_TOGGLE  = "ticket.toggle";
    case TICKET_DELETE  = "ticket.delete";
    case TICKET_RESTORE = "ticket.restore";
    //message
    case MESSAGE_ALL     = "message.all";
    case MESSAGE_INDEX   = "message.index";
    case MESSAGE_SHOW    = "message.show";
    case MESSAGE_STORE   = "message.store";
    case MESSAGE_UPDATE  = "message.update";
    case MESSAGE_TOGGLE  = "message.toggle";
    case MESSAGE_DELETE  = "message.delete";
    case MESSAGE_RESTORE = "message.restore";
    //product
    case product_ALL     = "product.all";
    case product_INDEX   = "product.index";
    case product_SHOW    = "product.show";
    case product_STORE   = "product.store";
    case product_UPDATE  = "product.update";
    case product_TOGGLE  = "product.toggle";
    case product_DELETE  = "product.delete";
    case product_RESTORE = "product.restore";
    //category
    case CATEGORY_ALL     = "category.all";
    case CATEGORY_INDEX   = "category.index";
    case CATEGORY_SHOW    = "category.show";
    case CATEGORY_STORE   = "category.store";
    case CATEGORY_UPDATE  = "category.update";
    case CATEGORY_TOGGLE  = "category.toggle";
    case CATEGORY_DELETE  = "category.delete";
    case CATEGORY_RESTORE = "category.restore";
    //cycle
    case CYCLE_ALL     = "cycle.all";
    case CYCLE_INDEX   = "cycle.index";
    case CYCLE_SHOW    = "cycle.show";
    case CYCLE_STORE   = "cycle.store";
    case CYCLE_UPDATE  = "cycle.update";
    case CYCLE_TOGGLE  = "cycle.toggle";
    case CYCLE_DELETE  = "cycle.delete";
    case CYCLE_RESTORE = "cycle.restore";
    //plan
    case PLAN_ALL     = "plan.all";
    case PLAN_INDEX   = "plan.index";
    case PLAN_SHOW    = "plan.show";
    case PLAN_STORE   = "plan.store";
    case PLAN_UPDATE  = "plan.update";
    case PLAN_TOGGLE  = "plan.toggle";
    case PLAN_DELETE  = "plan.delete";
    case PLAN_RESTORE = "plan.restore";
    //service
    case SERVICE_ALL     = "service.all";
    case SERVICE_INDEX   = "service.index";
    case SERVICE_SHOW    = "service.show";
    case SERVICE_STORE   = "service.store";
    case SERVICE_UPDATE  = "service.update";
    case SERVICE_TOGGLE  = "service.toggle";
    case SERVICE_DELETE  = "service.delete";
    case SERVICE_RESTORE = "service.restore";
    //video
    case VIDEO_ALL     = "video.all";
    case VIDEO_INDEX   = "video.index";
    case VIDEO_SHOW    = "video.show";
    case VIDEO_STORE   = "video.store";
    case VIDEO_UPDATE  = "video.update";
    case VIDEO_TOGGLE  = "video.toggle";
    case VIDEO_DELETE  = "video.delete";
    case VIDEO_RESTORE = "video.restore";
}
