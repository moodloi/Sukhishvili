

-- ----------------------------
-- Table structure for attendance
-- ----------------------------
DROP TABLE IF EXISTS "attendance";
CREATE TABLE "attendance" (
  "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "student_id" integer NOT NULL,
  "group_id" integer NOT NULL,
  "date" date NOT NULL,
  "present" tinyint(1) NOT NULL,
  "comment" text,
  "created_at" datetime,
  "updated_at" datetime,
  "deleted_at" datetime,
  FOREIGN KEY ("student_id") REFERENCES "students" ("id") ON DELETE CASCADE ON UPDATE NO ACTION,
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
  "valid_to" date NOT NULL DEFAULT '2999-12-31',
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
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS "model_has_permissions";
CREATE TABLE "model_has_permissions" (
  "permission_id" integer NOT NULL,
  "model_type" varchar NOT NULL,
  "model_id" integer NOT NULL,
  PRIMARY KEY ("permission_id", "model_id", "model_type"),
  FOREIGN KEY ("permission_id") REFERENCES "permissions" ("id") ON DELETE CASCADE ON UPDATE NO ACTION
);

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS "model_has_roles";
CREATE TABLE "model_has_roles" (
  "role_id" integer NOT NULL,
  "model_type" varchar NOT NULL,
  "model_id" integer NOT NULL,
  PRIMARY KEY ("role_id", "model_id", "model_type"),
  FOREIGN KEY ("role_id") REFERENCES "roles" ("id") ON DELETE CASCADE ON UPDATE NO ACTION
);

-- ----------------------------
-- Table structure for packages
-- ----------------------------
DROP TABLE IF EXISTS "packages";
CREATE TABLE "packages" (
  "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "name" varchar NOT NULL,
  "description" text,
  "price" numeric NOT NULL,
  "is_active" tinyint(1) NOT NULL DEFAULT '1',
  "comment" text,
  "valid_from" date NOT NULL,
  "valid_to" date NOT NULL DEFAULT '2999-12-31',
  "created_at" datetime,
  "updated_at" datetime,
  "deleted_at" datetime
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
  FOREIGN KEY ("student_id") REFERENCES "students" ("id") ON DELETE CASCADE ON UPDATE NO ACTION
);


-- ----------------------------
-- Table structure for payments
-- ----------------------------
DROP TABLE IF EXISTS "payments";
CREATE TABLE "payments" (
  "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "student_id" integer NOT NULL,
  "parent_id" integer NOT NULL,
  "student_package_id" integer NOT NULL,
  "amount" numeric NOT NULL,
  "status" varchar NOT NULL DEFAULT 'pending',
  "payment_method" varchar,
  "transaction_id" varchar,
  "notes" text,
  "created_at" datetime,
  "updated_at" datetime,
  "deleted_at" datetime,
  FOREIGN KEY ("student_id") REFERENCES "students" ("id") ON DELETE CASCADE ON UPDATE NO ACTION,
  FOREIGN KEY ("parent_id") REFERENCES "users" ("id") ON DELETE CASCADE ON UPDATE NO ACTION,
  FOREIGN KEY ("student_package_id") REFERENCES "student_packages" ("id") ON DELETE CASCADE ON UPDATE NO ACTION,
   ("status" in ('pending', 'completed', 'failed', 'refunded'))
);

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS "permissions";
CREATE TABLE "permissions" (
  "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "name" varchar NOT NULL,
  "guard_name" varchar NOT NULL,
  "created_at" datetime,
  "updated_at" datetime
);

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS "role_has_permissions";
CREATE TABLE "role_has_permissions" (
  "permission_id" integer NOT NULL,
  "role_id" integer NOT NULL,
  PRIMARY KEY ("permission_id", "role_id"),
  FOREIGN KEY ("permission_id") REFERENCES "permissions" ("id") ON DELETE CASCADE ON UPDATE NO ACTION,
  FOREIGN KEY ("role_id") REFERENCES "roles" ("id") ON DELETE CASCADE ON UPDATE NO ACTION
);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS "roles";
CREATE TABLE "roles" (
  "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "name" varchar NOT NULL,
  "guard_name" varchar NOT NULL,
  "created_at" datetime,
  "updated_at" datetime
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
  "deleted_at" datetime,
  "created_at" datetime,
  "updated_at" datetime
);

-- ----------------------------
-- Table structure for student_group
-- ----------------------------
DROP TABLE IF EXISTS "student_group";
CREATE TABLE "student_group" (
  "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "student_id" integer NOT NULL,
  "group_id" integer NOT NULL,
  "valid_from" date NOT NULL,
  "valid_to" date NOT NULL DEFAULT '2999-12-31',
  "created_at" datetime,
  "updated_at" datetime,
  "deleted_at" datetime,
  FOREIGN KEY ("student_id") REFERENCES "students" ("id") ON DELETE CASCADE ON UPDATE NO ACTION,
  FOREIGN KEY ("group_id") REFERENCES "groups" ("id") ON DELETE CASCADE ON UPDATE NO ACTION
);

-- ----------------------------
-- Table structure for student_packages
-- ----------------------------
DROP TABLE IF EXISTS "student_packages";
CREATE TABLE "student_packages" (
  "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "student_id" integer NOT NULL,
  "package_id" integer NOT NULL,
  "start_date" date NOT NULL,
  "end_date" date NOT NULL,
  "status" varchar NOT NULL DEFAULT 'active',
  "comment" text,
  "created_at" datetime,
  "updated_at" datetime,
  "deleted_at" datetime,
  FOREIGN KEY ("student_id") REFERENCES "students" ("id") ON DELETE CASCADE ON UPDATE NO ACTION,
  FOREIGN KEY ("package_id") REFERENCES "packages" ("id") ON DELETE CASCADE ON UPDATE NO ACTION,
   ("status" in ('active', 'expired', 'cancelled'))
);

-- ----------------------------
-- Table structure for students
-- ----------------------------
DROP TABLE IF EXISTS "students";
CREATE TABLE "students" (
  "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "first_name" varchar NOT NULL,
  "last_name" varchar NOT NULL,
  "pid" varchar NOT NULL,
  "date_of_birth" date NOT NULL,
  "gender" varchar,
  "comment" text,
  "created_at" datetime,
  "updated_at" datetime,
  "deleted_at" datetime,
   ("gender" in ('male', 'female'))
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
  "valid_to" date NOT NULL DEFAULT '2999-12-31',
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

-- ----------------------------
-- Indexes structure for table model_has_permissions
-- ----------------------------
CREATE INDEX "model_has_permissions_model_id_model_type_index"
ON "model_has_permissions" (
  "model_id" ASC,
  "model_type" ASC
);

-- ----------------------------
-- Indexes structure for table model_has_roles
-- ----------------------------
CREATE INDEX "model_has_roles_model_id_model_type_index"
ON "model_has_roles" (
  "model_id" ASC,
  "model_type" ASC
);

-- ----------------------------
-- Indexes structure for table permissions
-- ----------------------------
CREATE UNIQUE INDEX "permissions_name_guard_name_unique"
ON "permissions" (
  "name" ASC,
  "guard_name" ASC
);
-- ----------------------------
-- Indexes structure for table roles
-- ----------------------------
CREATE UNIQUE INDEX "roles_name_guard_name_unique"
ON "roles" (
  "name" ASC,
  "guard_name" ASC
);

-- ----------------------------
-- Indexes structure for table sessions
-- ----------------------------
CREATE INDEX "sessions_last_activity_index"
ON "sessions" (
  "last_activity" ASC
);
CREATE INDEX "sessions_user_id_index"
ON "sessions" (
  "user_id" ASC
);

-- ----------------------------
-- Indexes structure for table students
-- ----------------------------
CREATE INDEX "students_pid_index"
ON "students" (
  "pid" ASC
);

-- ----------------------------
-- Indexes structure for table users
-- ----------------------------
CREATE UNIQUE INDEX "users_email_unique"
ON "users" (
  "email" ASC
);
