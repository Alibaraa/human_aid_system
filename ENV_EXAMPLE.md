# مثال على ملف .env لإعدادات قاعدة البيانات

## ملاحظة مهمة عن علامات الاقتباس:

**في CodeIgniter، علامات الاقتباس اختيارية في ملف .env**، لكن يُنصح باستخدامها في الحالات التالية:
- القيم التي تحتوي على مسافات
- القيم التي تحتوي على رموز خاصة
- كلمات المرور التي قد تحتوي على رموز خاصة

## الصيغة الصحيحة لملف .env:

```env
# إعدادات قاعدة البيانات لـ DigitalOcean
# بدون علامات اقتباس - يعمل بشكل صحيح
database_default_hostname=db-mysql-sfo3-22518-do-user-28239552-0.f.db.ondigitalocean.com
database_default_username=doadmin
database_default_database=defaultdb
database_default_DBDriver=MySQLi
database_default_port=25060

# مع علامات اقتباس - يعمل أيضاً بشكل صحيح
database_default_password="AVNS_Z5F_ZQRYWrbwaMB9dw7"

# أو بدون علامات اقتباس - يعمل أيضاً
database_default_password=AVNS_Z5F_ZQRYWrbwaMB9dw7
```

## الصيغة الموصى بها:

```env
# إعدادات قاعدة البيانات
database_default_hostname=db-mysql-sfo3-22518-do-user-28239552-0.f.db.ondigitalocean.com
database_default_username=doadmin
database_default_password=AVNS_Z5F_ZQRYWrbwaMB9dw7
database_default_database=defaultdb
database_default_DBDriver=MySQLi
database_default_port=25060
```

## ملاحظات مهمة:

1. **لا تضع مسافات حول علامة =**: ❌ `key = value` ✅ `key=value`
2. **علامات الاقتباس اختيارية**: يمكنك استخدامها أو عدم استخدامها
3. **استخدم علامات الاقتباس فقط إذا كانت القيمة تحتوي على مسافات أو رموز خاصة**
4. **لا تستخدم علامات اقتباس داخلية** إذا كنت تستخدم علامات اقتباس خارجية
5. **تأكد من عدم وجود مسافات في بداية أو نهاية القيمة** (CodeIgniter يقوم بتقليمها تلقائياً)

## أمثلة للقيم التي تحتاج علامات اقتباس:

```env
# إذا كانت القيمة تحتوي على مسافات
some_key="value with spaces"

# إذا كانت القيمة تحتوي على رموز خاصة
some_key="value#with@special$chars"

# لكن في حالتك، كلمة المرور لا تحتاج علامات اقتباس
database_default_password=AVNS_Z5F_ZQRYWrbwaMB9dw7
```

