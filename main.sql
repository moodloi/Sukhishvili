

-- ----------------------------
-- Table structure for attendance
-- ----------------------------
DROP TABLE IF EXISTS "attendance";
CREATE TABLE "attendance" (
  "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "user_id" integer NOT NULL,
  "group_id" integer NOT NULL,
  "date" date NOT NULL,
  "present" tinyint(1) NOT NULL,
  "comment" text,
  "created_at" datetime,
  "updated_at" datetime,
  "deleted_at" datetime,
  FOREIGN KEY ("user_id") REFERENCES "users" ("id") ON DELETE CASCADE ON UPDATE NO ACTION,
  FOREIGN KEY ("group_id") REFERENCES "groups" ("id") ON DELETE CASCADE ON UPDATE NO ACTION
);


-- ----------------------------
-- Table structure for groups
-- ----------------------------
DROP TABLE IF EXISTS "groups";
CREATE TABLE "groups" (
  "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "name" varchar NOT NULL,
  "service_center_id" integer NOT NULL,
  "created_at" datetime,
  "updated_at" datetime,
  "deleted_at" datetime,
  FOREIGN KEY ("service_center_id") REFERENCES "service_centers" ("id") ON DELETE CASCADE ON UPDATE NO ACTION
);


-- ----------------------------
-- Table structure for manager_service_center
-- ----------------------------
DROP TABLE IF EXISTS "manager_service_center";
CREATE TABLE "manager_service_center" (
  "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "user_id" integer NOT NULL,
  "service_center_id" integer NOT NULL,
  "valid_from" date NOT NULL,
  "valid_to" date NOT NULL DEFAULT '2999-01-01',
  "comment" text,
  "created_at" datetime,
  "updated_at" datetime,
  "deleted_at" datetime,
  FOREIGN KEY ("user_id") REFERENCES "users" ("id") ON DELETE CASCADE ON UPDATE NO ACTION,
  FOREIGN KEY ("service_center_id") REFERENCES "service_centers" ("id") ON DELETE CASCADE ON UPDATE NO ACTION
);

-- ----------------------------
-- Table structure for messages
-- ----------------------------
DROP TABLE IF EXISTS "messages";
CREATE TABLE "messages" (
  "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "sender_id" integer NOT NULL,
  "recipient_id" integer NOT NULL,
  "content" text NOT NULL,
  "read_at" datetime,
  "created_at" datetime,
  "updated_at" datetime,
  "deleted_at" datetime,
  FOREIGN KEY ("sender_id") REFERENCES "users" ("id") ON DELETE CASCADE ON UPDATE NO ACTION,
  FOREIGN KEY ("recipient_id") REFERENCES "users" ("id") ON DELETE CASCADE ON UPDATE NO ACTION
);


-- ----------------------------
-- Table structure for parent_student
-- ----------------------------
DROP TABLE IF EXISTS "parent_student";
CREATE TABLE "parent_student" (
  "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "parent_id" integer NOT NULL,
  "student_id" integer NOT NULL,
  "comment" text,
  "created_at" datetime,
  "updated_at" datetime,
  "deleted_at" datetime,
  FOREIGN KEY ("parent_id") REFERENCES "users" ("id") ON DELETE CASCADE ON UPDATE NO ACTION,
  FOREIGN KEY ("student_id") REFERENCES "users" ("id") ON DELETE CASCADE ON UPDATE NO ACTION
);


-- ----------------------------
-- Table structure for service_centers
-- ----------------------------
DROP TABLE IF EXISTS "service_centers";
CREATE TABLE "service_centers" (
  "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "business" varchar NOT NULL,
  "name" varchar NOT NULL,
  "address" varchar NOT NULL,
  "phone" varchar,
  "comment" text,
  "del_flag" tinyint(1) NOT NULL DEFAULT '0',
  "created_at" datetime,
  "updated_at" datetime
);


-- ----------------------------
-- Table structure for student_group
-- ----------------------------
DROP TABLE IF EXISTS "student_group";
CREATE TABLE "student_group" (
  "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "user_id" integer NOT NULL,
  "group_id" integer NOT NULL,
  "valid_from" date NOT NULL,
  "valid_to" date NOT NULL DEFAULT '2999-01-01',
  "created_at" datetime,
  "updated_at" datetime,
  "deleted_at" datetime,
  FOREIGN KEY ("user_id") REFERENCES "users" ("id") ON DELETE CASCADE ON UPDATE NO ACTION,
  FOREIGN KEY ("group_id") REFERENCES "groups" ("id") ON DELETE CASCADE ON UPDATE NO ACTION
);

-- ----------------------------
-- Table structure for teacher_group
-- ----------------------------
DROP TABLE IF EXISTS "teacher_group";
CREATE TABLE "teacher_group" (
  "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "user_id" integer NOT NULL,
  "group_id" integer NOT NULL,
  "valid_from" date NOT NULL,
  "valid_to" date NOT NULL DEFAULT '2999-01-01',
  "comment" text,
  "created_at" datetime,
  "updated_at" datetime,
  "deleted_at" datetime,
  FOREIGN KEY ("user_id") REFERENCES "users" ("id") ON DELETE CASCADE ON UPDATE NO ACTION,
  FOREIGN KEY ("group_id") REFERENCES "groups" ("id") ON DELETE CASCADE ON UPDATE NO ACTION
);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS "users";
CREATE TABLE "users" (
  "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "name" varchar NOT NULL,
  "email" varchar NOT NULL,
  "email_verified_at" datetime,
  "password" varchar NOT NULL,
  "remember_token" varchar,
  "created_at" datetime,
  "updated_at" datetime
);
