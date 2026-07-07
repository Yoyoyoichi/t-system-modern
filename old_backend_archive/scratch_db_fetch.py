import psycopg2
import json

def main():
    connection_uri = "postgresql://postgres.eqtxzxqvkprnmkiyczvv:%40%2FL5WG%2Cs%40xcqT%255@aws-1-ap-northeast-1.pooler.supabase.com:5432/postgres?sslmode=require"
    try:
        conn = psycopg2.connect(connection_uri)
        cursor = conn.cursor()
        
        # 1. 存在するテーブル一覧の調査
        cursor.execute("SELECT table_name FROM information_schema.tables WHERE table_schema='public';")
        tables = cursor.fetchall()
        print("--- Public Tables ---")
        for table in tables:
            print(f"- {table[0]}")
        print()

        # テーブル一覧から英検一級に該当しそうなテーブル、または特定の質問テーブルを特定する
        # （通常は 'questions' や 'question_table'、あるいは getqestions.php の $db_name に入っているもの）
        # テーブル名が取得できたら、そのテーブルの「category1」「category2」等で '英検一級' または 'Eiken 1' などが入っているレコードを検索
        # ここでは一番可能性の高い 'english' またはテーブル一覧を元にした全件検索を行います
        
        for t in tables:
            table_name = t[0]
            try:
                # テーブルのカラムを確認
                cursor.execute(f"SELECT column_name FROM information_schema.columns WHERE table_name='{table_name}';")
                columns = [col[0] for col in cursor.fetchall()]
                
                # 'question' または 'category' カラムがあるテーブルに対してクエリを実行
                if 'question' in columns or any('category' in col for col in columns):
                    print(f"Searching in table: {table_name} (Columns: {columns[:5]}...)")
                    # 英検一級に関連しそうなレコードを取得
                    # category1 ~ category5 等に「一級」や「1級」や「eiken」などが含まれるものを検索
                    search_query = f"""
                        SELECT * FROM {table_name} 
                        WHERE 
                            (category1 ILIKE '%一級%' OR category1 ILIKE '%1級%' OR category1 ILIKE '%eiken%')
                            OR (category2 ILIKE '%一級%' OR category2 ILIKE '%1級%' OR category2 ILIKE '%eiken%')
                            OR (category3 ILIKE '%一級%' OR category3 ILIKE '%1級%' OR category3 ILIKE '%eiken%')
                        LIMIT 3;
                    """
                    cursor.execute(search_query)
                    rows = cursor.fetchall()
                    if rows:
                        print(f"Found {len(rows)} matching question(s) in {table_name}:")
                        for row in rows:
                            # 辞書形式にして見やすく出力
                            row_dict = dict(zip(columns, row))
                            # テキストが長すぎる場合は切り詰め
                            clean_dict = {k: (str(v)[:100] + '...' if len(str(v)) > 100 else v) for k, v in row_dict.items()}
                            print(json.dumps(clean_dict, ensure_ascii=False, indent=2))
                    else:
                        print("No direct 'Eiken 1' category matches in this table.")
            except Exception as ex:
                print(f"Error querying table {table_name}: {ex}")
                conn.rollback()

        cursor.close()
        conn.close()
    except Exception as e:
        print("Database connection failed:", e)

if __name__ == "__main__":
    main()
